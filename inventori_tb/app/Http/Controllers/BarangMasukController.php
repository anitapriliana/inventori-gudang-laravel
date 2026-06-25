<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

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
        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        return view('barang_masuk.create', compact('barang'));
    }

    /**
     * AJAX Ambil Merk Berdasarkan Nama Barang
     */
    public function getMerk($nama_barang)
    {
        $barang = Barang::where('nama_barang', $nama_barang)->get();

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
            'tanggal' => 'required|date'
        ]);

        // Ambil barang berdasarkan ID
        $barang = Barang::findOrFail($request->barang_id);

        // Simpan transaksi barang masuk
        BarangMasuk::create([
            'barang_id' => $barang->id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal
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
