<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | menampilkan data barang keluar
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
    | form input barang keluar
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $barang = Barang::with('kategoriData')
            ->orderBy('nama_barang', 'asc')
            ->get();

        // ambil semua proyek buat ditampilkan di dropdown form
        $proyeks = \App\Models\Proyek::orderBy('nama_proyek', 'asc')->get();

        return view('barang_keluar.create', compact('barang', 'proyeks'));
    }

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

    /*
    |--------------------------------------------------------------------------
    | simpan data barang keluar
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date',
            'proyek_id' => 'nullable|exists:proyeks,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // cek stok
        if ($barang->stok < $request->jumlah) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Stok tidak mencukupi!');
        }

        // simpan transaksi barang keluar
        BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'proyek_id' => $request->proyek_id,
            'jumlah'    => $request->jumlah,
            'tanggal'   => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        // kurangi stok
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil disimpan!');
    }

    /*
    |--------------------------------------------------------------------------
    | hapus data barang keluar dan kembalikan stok
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barang = Barang::find($barangKeluar->barang_id);

        // kembalikan stok
        if ($barang) {
            $barang->stok += $barangKeluar->jumlah;
            $barang->save();
        }

        $barangKeluar->delete();

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | form input retur barang
    |--------------------------------------------------------------------------
    */

    public function returnCreate()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        return view('barang_keluar.return', compact('barang'));
    }

    /*
    |--------------------------------------------------------------------------
    | simpan data retur barang
    |--------------------------------------------------------------------------
    */

    public function returnStore(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date',
            'alasan'    => 'required|string|max:255',
        ]);

        // ambil data barang
        $barang = Barang::findOrFail($request->barang_id);

        // cek stok tersedia
        if ($barang->stok < $request->jumlah) {
            return redirect()
                ->back()
                ->with('error', 'Jumlah return melebihi stok yang tersedia!');
        }

        // kurangi stok karena barang direturn ke supplier
        $barang->stok -= $request->jumlah;
        $barang->save();

        // simpan data return
        BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'jumlah'    => $request->jumlah,
            'tanggal'   => $request->tanggal,
            'alasan'    => $request->alasan,
            'status'    => 'returned',
        ]);

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Barang berhasil direturn ke supplier!');
    }

    /*
    |--------------------------------------------------------------------------
    | edit data barang keluar
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        return redirect()
            ->route('barang-keluar.index')
            ->with('error', 'Fitur edit barang keluar belum tersedia.');
    }

    public function update(Request $request, $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        return redirect()
            ->route('barang-keluar.index')
            ->with('error', 'Fitur edit barang keluar belum tersedia.');
    }
}
