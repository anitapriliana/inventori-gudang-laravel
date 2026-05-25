<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

/**
 * Class BarangController
 * 
 * Mengelola fungsionalidad CRUD untuk data barang, termasuk pencarian,
 * pengelompokan kategori, pembuatan kode barang otomatis, pengunggahan gambar,
 * serta penanganan pengalihan kembali ke URL asal (kategori/pencarian).
 */
class BarangController extends Controller
{
    /**
     * Menampilkan daftar data barang dengan dukungan filter pencarian, 
     * filter kategori, urutan alami (natural sorting), dan pagination.
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();

        $barang = Barang::with('kategoriData')
            ->withMin(['barangMasuk as tanggal_kadaluwarsa_terdekat' => function ($query) {
                $query->where('sisa_jumlah', '>', 0)
                    ->whereNotNull('tanggal_kadaluwarsa');
            }], 'tanggal_kadaluwarsa')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_barang', 'LIKE', "%{$request->search}%")
                        ->orWhere('merk', 'LIKE', "%{$request->search}%");
                });
            })
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $kategoriId = (int) $request->kategori;
                $kategoriName = $kategoriId ? Kategori::find($kategoriId)?->nama_kategori : null;

                $query->where(function ($q) use ($kategoriId, $kategoriName) {
                    if ($kategoriId) {
                        $q->where('kategori_id', $kategoriId);
                    }

                    if ($kategoriName) {
                        $q->orWhere('kategori', $kategoriName);
                    }
                });
            })
            ->orderByRaw("REGEXP_REPLACE(nama_barang, '[0-9]+', '') ASC")
            ->orderByRaw("CAST(REGEXP_SUBSTR(nama_barang, '[0-9]+') AS UNSIGNED) ASC")
            ->paginate(10)
            ->withQueryString();

        return view('barang.index', compact('barang', 'kategoris'));
    }

    /**
     * Menampilkan formulir penambahan barang baru.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('barang.create', compact('kategoris'));
    }

    /**
     * Menyimpan data barang baru ke dalam database dan membuat kode barang otomatis.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input barang
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_barang' => [
                'required',
                'string',
                Rule::unique('barang')->where(function ($query) use ($request) {
                    return $query->where('merk', $request->merk);
                }),
            ],
            'merk' => 'required|string',
            'supplier' => 'nullable|string|max:100',
            'stok' => 'required|numeric|min:0',
            'satuan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_barang.unique' => 'Barang dengan nama dan merk yang sama sudah ada.',
            'kategori_id.required' => 'Kategori harus dipilih.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $kategori = Kategori::findOrFail($request->kategori_id);

        // Generasi kode barang unik berdasarkan prefix kode kategori
        $prefix = $kategori->kode_kategori;

        $last = Barang::where('kategori_id', $kategori->id)
            ->whereNotNull('kode_barang')
            ->orderBy('id', 'desc')
            ->first();

        $number = 1;

        if ($last && !empty($last->kode_barang)) {
            if (preg_match('/(\d+)$/', $last->kode_barang, $m)) {
                $number = (int) $m[1] + 1;
            }
        }

        $kode = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Upload berkas gambar jika diunggah
        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('barang', 'public');
        }

        // Simpan data barang baru
        Barang::create([
            'kode_barang' => $kode,
            'kategori_id' => $request->kategori_id,
            'kategori' => $kategori->nama_kategori,
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'supplier' => $request->supplier,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'gambar' => $gambarPath,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Menampilkan formulir penyuntingan data barang.
     * 
     * @param int|string $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Memperbarui data barang di database serta mengarahkan kembali ke halaman asal (kategori).
     * 
     * @param Request $request
     * @param int|string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => [
                'required',
                'string',
                Rule::unique('barang')
                    ->where(fn($query) => $query->where('merk', $request->merk))
                    ->ignore($id),
            ],
            'merk' => 'required|string',
            'supplier' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_barang.unique' => 'Barang dengan nama dan merk yang sama sudah ada.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $barang = Barang::findOrFail($id);

        $dataUpdate = [
            'nama_barang' => $request->nama_barang,
            'merk' => $request->merk,
            'supplier' => $request->supplier,
            'kategori_id' => $request->kategori_id ?? $barang->kategori_id,
            'kategori' => $request->filled('kategori_id')
                ? Kategori::find($request->kategori_id)?->nama_kategori ?? $barang->kategori
                : $barang->kategori,
        ];

        // Ganti gambar jika ada file baru yang diunggah
        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            $dataUpdate['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($dataUpdate);

        // Jika terdapat rujukan redirect_to dari form, kembalikan ke URL tersebut
        if ($request->filled('redirect_to')) {
            return redirect($request->redirect_to)->with('success', 'Barang berhasil diupdate');
        }

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil diupdate');
    }

    /**
     * Menghapus data barang beserta gambar terkait, lalu mengembalikan posisi
     * tampilan ke halaman kategori/filter tempat barang tersebut dihapus.
     * 
     * @param int|string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus file gambar dari penyimpanan jika tersedia
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        // Mengembalikan pengguna ke halaman asal (termasuk query filter kategori)
        return redirect()->back()->with('success', 'Barang berhasil dihapus');
    }
}
