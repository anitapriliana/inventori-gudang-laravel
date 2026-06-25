<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MENAMPILKAN DATA BARANG KELUAR
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
    | FORM INPUT BARANG KELUAR
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        return view('barang_keluar.create', compact('barang'));
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX AMBIL MERK BERDASARKAN NAMA BARANG
    |--------------------------------------------------------------------------
    */

    public function getMerk($nama_barang)
    {
        $barang = Barang::where('nama_barang', $nama_barang)->get();

        return response()->json($barang);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA BARANG KELUAR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Cek stok
        if ($barang->stok < $request->jumlah) {

            return redirect()
                ->back()
                ->with('error', 'Stok tidak mencukupi!');
        }

        // Simpan transaksi barang keluar
        BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'jumlah'    => $request->jumlah,
            'tanggal'   => $request->tanggal
        ]);

        // Kurangi stok
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil disimpan!');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA BARANG KELUAR
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barang = Barang::find($barangKeluar->barang_id);

        // Kembalikan stok
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
    | FORM RETURN BARANG
    |--------------------------------------------------------------------------
    */

    public function returnCreate()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        return view('barang_keluar.return', compact('barang'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA RETURN BARANG
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

        // Ambil data barang
        $barang = Barang::findOrFail($request->barang_id);

        // Cek stok tersedia
        if ($barang->stok < $request->jumlah) {

            return redirect()
                ->back()
                ->with('error', 'Jumlah return melebihi stok yang tersedia!');
        }

        // Kurangi stok karena barang direturn ke supplier
        $barang->stok -= $request->jumlah;
        $barang->save();

        // Simpan data return
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
}
