<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Proyek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Controller untuk mengelola transaksi Barang Keluar dan Pengembalian Sisa Proyek.
 * Lokasi File: app/Http/Controllers/BarangKeluarController.php
 */
class BarangKeluarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan Data Barang Keluar
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data = BarangKeluar::with('barang')
            ->whereDate('tanggal', now())
            ->latest()
            ->paginate(10)
            ->withQueryString();



        return view('barang_keluar.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | Form Input Barang Keluar
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $barang = Barang::with('kategoriData')
            ->orderBy('nama_barang', 'asc')
            ->get();

        $proyeks = Proyek::orderBy('nama_proyek', 'asc')->get();

        return view('barang_keluar.create', compact('barang', 'proyeks'));
    }

    /*
    |--------------------------------------------------------------------------
    | Ajax Fetch Details/Merk Berdasarkan Nama Barang
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | Simpan Data Barang Keluar
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'  => 'required|exists:barang,id',
            'jumlah'     => 'required|numeric|min:0.01',
            'tanggal'    => 'required|date_format:d/m/Y', // format dari datepicker
            'proyek_id'  => 'nullable|exists:proyeks,id',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.date_format' => 'Format tanggal harus dd/mm/yyyy.',
        ]);

        // ubah d/m/Y ke Y-m-d biar kebaca benar di database
        $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

        try {
            DB::transaction(function () use ($request, $tanggal) {
                $barang = Barang::lockForUpdate()->findOrFail($request->barang_id);

                if ($barang->stok < $request->jumlah) {
                    throw new \Exception('Stok tidak mencukupi untuk dikeluarkan!');
                }

                BarangKeluar::create([
                    'barang_id'  => $request->barang_id,
                    'proyek_id'  => $request->proyek_id,
                    'jumlah'     => $request->jumlah,
                    'tanggal'    => $tanggal,
                    'keterangan' => $request->keterangan,
                ]);

                $barang->decrement('stok', $request->jumlah);
            });

            return redirect()
                ->route('barang-keluar.index')
                ->with('success', 'Data barang keluar berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Kembalikan Sisa Bahan Dari Proyek Ke Gudang
    |--------------------------------------------------------------------------
    */
    public function kembalikanSisaProyek(Request $request, $id)
    {
        $request->validate([
            'jumlah_kembali' => 'required|numeric|min:0.01',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);
        $jumlahKembali = (float) $request->jumlah_kembali;

        if ($jumlahKembali > $barangKeluar->jumlah) {
            return back()->withErrors(['jumlah_kembali' => 'Jumlah yang dikembalikan melebihi sisa yang tercatat di proyek.']);
        }

        DB::transaction(function () use ($barangKeluar, $jumlahKembali) {
            $barang = Barang::lockForUpdate()->findOrFail($barangKeluar->barang_id);
            $barang->increment('stok', $jumlahKembali);

            if ($barangKeluar->jumlah == $jumlahKembali) {
                $barangKeluar->delete();
            } else {
                $barangKeluar->decrement('jumlah', $jumlahKembali);
            }
        });

        return back()->with('success', 'Sisa bahan berhasil dikembalikan ke gudang dan stok bertambah!');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Data Barang Keluar Dan Kembalikan Stok
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $barangKeluar = BarangKeluar::findOrFail($id);
            $barang = Barang::lockForUpdate()->find($barangKeluar->barang_id);

            if ($barang) {
                $barang->increment('stok', $barangKeluar->jumlah);
            }

            $barangKeluar->delete();
        });

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil dihapus!');
    }

    public function edit($id)
    {
        return redirect()
            ->route('barang-keluar.index')
            ->with('error', 'Fitur edit barang keluar belum tersedia.');
    }

    public function update(Request $request, $id)
    {
        return redirect()
            ->route('barang-keluar.index')
            ->with('error', 'Fitur edit barang keluar belum tersedia.');
    }
}
