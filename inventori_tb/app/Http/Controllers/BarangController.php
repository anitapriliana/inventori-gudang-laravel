<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    // Menampilkan data barang
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $barang = Barang::query()

            // Search
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_barang', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('merk', 'LIKE', '%' . $request->search . '%');
                });
            })

            // Filter kategori
            ->when($request->kategori, function ($query) use ($request) {
                $query->where('kategori', $request->kategori);
            })

            // Sorting
            ->orderByRaw("REGEXP_REPLACE(nama_barang, '[0-9]+', '') ASC")
            ->orderByRaw("CAST(REGEXP_SUBSTR(nama_barang, '[0-9]+') AS UNSIGNED) ASC")

            // Pagination
            ->paginate(10)
            ->withQueryString();

        return view('barang.index', compact('barang', 'kategoris'));
    }

    // Form tambah barang
    public function create()
    {
        $kategoris = Kategori::all();

        return view('barang.create', compact('kategoris'));
    }

    // Simpan barang
    public function store(Request $request)
    {
        // Validasi kategori kosong
        if (!$request->kategori && !$request->kategori_baru) {

            return back()
                ->withErrors([
                    'kategori' => 'Pilih kategori atau tambah kategori baru.'
                ])
                ->withInput();
        }

        // Tambah kategori baru
        if ($request->kategori_baru) {

            $namaKategori = strtoupper($request->kategori_baru);

            // Generate kode kategori
            $words = explode(' ', $namaKategori);

            $kodeKategori = '';

            foreach ($words as $word) {
                $kodeKategori .= substr($word, 0, 2);
            }

            $kodeKategori = substr($kodeKategori, 0, 4);

            // Simpan kategori
            Kategori::create([
                'kode_kategori' => $kodeKategori,
                'nama_kategori' => $namaKategori
            ]);

            // Masukkan ke request
            $request->merge([
                'kategori' => $namaKategori
            ]);
        }

        // Validasi input
        $request->validate([

            'kategori' => 'nullable',
            'kategori_baru' => 'nullable',

            'nama_barang' => [
                'required',
                'string',

                Rule::unique('barang')->where(function ($query) use ($request) {
                    return $query->where('merk', $request->merk);
                }),
            ],

            'merk' => 'required',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required',

        ], [

            'nama_barang.unique' =>
            'Barang dengan nama dan merk yang sama sudah ada.',
        ]);

        // Generate prefix kode barang
        $prefix = substr(strtoupper($request->kategori), 0, 4);

        // Cari kode terakhir
        $last = Barang::where('kategori', $request->kategori)
            ->latest()
            ->first();

        $number = 1;

        if ($last && $last->kode_barang) {
            $number = (int) substr($last->kode_barang, -3) + 1;
        }

        // Generate kode barang
        $kode = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Simpan barang
        Barang::create([
            'kode_barang' => $kode,
            'kategori' => $request->kategori,
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    // Form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        $kategoris = Kategori::all();

        return view('barang.edit', compact('barang', 'kategoris'));
    }

    // Update barang
    public function update(Request $request, $id)
    {
        $request->validate([

            'kode_barang' =>
            'required|unique:barang,kode_barang,' . $id,

            'kategori' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required'
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'kategori' => $request->kategori,
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('barang.index', [
            'page' => $request->page
        ])->with('success', 'Barang berhasil diupdate');
    }

    // Hapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
