<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar data barang masuk
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
            ->where('nama_barang', $nama_barang)
            ->get()
            ->map(function ($b) {
                return [
                    'id' => $b->id,
                    'merk' => $b->merk,
                    'kode_barang' => $b->kode_barang,
                    'satuan' => $b->satuan,
                    'stok' => $b->stok,
                    'kategori' => $b->kategoriData?->nama_kategori ?? $b->kategori,
                ];
            });

        return response()->json($barang);
    }

    /**
     * Menyimpan data barang masuk
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'tanggal_kadaluwarsa' => 'nullable|date_format:Y-m',
        ]);

        // Ambil barang berdasarkan ID
        $barang = Barang::findOrFail($request->barang_id);

        // Konversi bulan kadaluwarsa (YYYY-MM) ke tanggal akhir bulan tersebut
        $tanggalKadaluwarsa = $request->tanggal_kadaluwarsa
            ? Carbon::createFromFormat('Y-m', $request->tanggal_kadaluwarsa)->endOfMonth()->toDateString()
            : null;

        // Simpan transaksi barang masuk sebagai batch baru
        BarangMasuk::create([
            'barang_id' => $barang->id,
            'jumlah' => $request->jumlah,
            'sisa_jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
        ]);

        // Tambah stok
        $barang->increment('stok', $request->jumlah);

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil disimpan!');
    }

    /**
     * Menghapus data barang masuk
     */
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Ambil barang terkait
        $barang = Barang::find($barangMasuk->barang_id);

        // Kurangi stok
        if ($barang) {

            $barang->decrement('stok', $barangMasuk->jumlah);

            // Cegah stok minus
            if ($barang->stok < 0) {

                $barang->stok = 0;
                $barang->save();
            }
        }

        // Hapus transaksi
        $barangMasuk->delete();

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil dihapus!');
    }
}
