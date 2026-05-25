<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Controller untuk mengelola data Barang Masuk dan Retur Barang ke Supplier.
 * Lokasi File: app/Http/Controllers/BarangMasukController.php
 */
class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar data barang masuk hari ini
     */
    public function index()
    {
        $data = BarangMasuk::with('barang')
            ->whereDate('tanggal', now())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('barang_masuk.index', compact('data'));
    }

    /**
     * Menampilkan form input barang masuk
     */
    public function create()
    {
        $barang = Barang::with('kategoriData')->orderBy('nama_barang', 'asc')->get();

        return view('barang_masuk.create', compact('barang'));
    }

    /**
     * AJAX Ambil Merk Berdasarkan Nama Barang
     */
    public function getMerk($nama_barang)
    {
        $barang = Barang::with('kategoriData')
            ->where('nama_barang', urldecode($nama_barang))
            ->get()
            ->map(function ($b) {
                return [
                    'id'          => $b->id,
                    'merk'        => $b->merk,
                    'kode_barang' => $b->kode_barang,
                    'satuan'      => $b->satuan,
                    'stok'        => $b->stok,
                    'kategori'    => $b->kategoriData?->nama_kategori ?? $b->kategori,
                ];
            });

        return response()->json($barang);
    }

    /**
     * Menyimpan data barang masuk (dengan DB Transaction)
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'           => 'required|exists:barang,id',
            'jumlah'              => 'required|numeric|min:0.01',
            'tanggal'             => 'required|date',
            'tanggal_kadaluwarsa' => 'nullable|date_format:Y-m',
        ]);

        // Konversi bulan kadaluwarsa (YYYY-MM) ke akhir bulan
        $tanggalKadaluwarsa = $request->tanggal_kadaluwarsa
            ? Carbon::createFromFormat('Y-m', $request->tanggal_kadaluwarsa)->endOfMonth()->toDateString()
            : null;

        try {
            DB::transaction(function () use ($request, $tanggalKadaluwarsa) {
                // Lock data barang untuk cegah race condition
                $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

                // Simpan transaksi barang masuk sebagai batch baru
                BarangMasuk::create([
                    'barang_id'           => $barang->id,
                    'jumlah'              => $request->jumlah,
                    'sisa_jumlah'         => $request->jumlah,
                    'tanggal'             => $request->tanggal,
                    'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
                ]);

                // Tambah stok secara atomic
                $barang->increment('stok', $request->jumlah);
            });

            return redirect()
                ->route('barang-masuk.index')
                ->with('success', 'Data barang masuk berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan barang masuk: ' . $e->getMessage());
        }
    }

    /**
     * Form Input Retur Barang Masuk Ke Supplier
     */
    public function returnCreate()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        return view('barang_masuk.return', compact('barang'));
    }

    /**
     * Menyimpan data retur barang ke supplier (Mengurangi stok gudang)
     */
    public function returnStore(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|numeric|min:0.01',
            'tanggal'   => 'required|date',
            'alasan'    => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Lock record barang untuk validasi stok yang aman
                $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

                // Cek ketersediaan stok sebelum dikembalikan ke supplier
                if ($barang->stok < $request->jumlah) {
                    throw new \Exception('Jumlah retur melebihi stok yang tersedia di gudang!');
                }

                // Kurangi stok barang karena dikembalikan ke supplier
                $barang->decrement('stok', $request->jumlah);

                // Catat transaksi retur pada tabel barang masuk (dengan keterangan retur)
                BarangMasuk::create([
                    'barang_id'  => $request->barang_id,
                    'jumlah'     => 0, // Jumlah masuk 0 karena ini transaksi pengeluaran retur
                    'sisa_jumlah' => 0,
                    'tanggal'    => $request->tanggal,
                    'keterangan' => 'RETUR SUPPLIER: ' . $request->alasan,
                ]);
            });

            return redirect()
                ->route('barang-masuk.index')
                ->with('success', 'Barang berhasil diretur ke supplier dan stok gudang berkurang!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Menghapus data barang masuk dan menyesuaikan stok gudang
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $barangMasuk = BarangMasuk::findOrFail($id);
                $barang = Barang::lockForUpdate()->find($barangMasuk->barang_id);

                if ($barang) {
                    $barang->decrement('stok', $barangMasuk->jumlah);

                    // Cegah stok minus jika terjadi kegagalan penghitungan
                    if ($barang->stok < 0) {
                        $barang->stok = 0;
                        $barang->save();
                    }
                }

                $barangMasuk->delete();
            });

            return redirect()
                ->route('barang-masuk.index')
                ->with('success', 'Data barang masuk berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->route('barang-masuk.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
