<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kodeKategori = $request->filled('kode_kategori')
            ? strtoupper(trim($request->kode_kategori))
            : 'KTG-' . strtoupper(Str::random(5));

        $validator = Validator::make($request->all() + ['kode_kategori' => $kodeKategori], [
            'kode_kategori' => 'required|string|max:20|unique:kategoris,kode_kategori',
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kode_kategori.required' => 'Kode kategori harus diisi',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan',
            'nama_kategori.required' => 'Nama kategori harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Kategori::create([
            'kode_kategori' => $kodeKategori,
            'nama_kategori' => strtoupper($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        $redirectTo = $request->input('redirect_to', 'kategori.index');

        return redirect()
            ->route($redirectTo)
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validator = Validator::make($request->all(), [
            'kode_kategori' => 'required|string|max:20|unique:kategoris,kode_kategori,' . $kategori->id,
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kode_kategori.required' => 'Kode kategori harus diisi',
            'kode_kategori.unique' => 'Kode kategori sudah digunakan',
            'nama_kategori.required' => 'Nama kategori harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kategori->update([
            'kode_kategori' => strtoupper($request->kode_kategori),
            'nama_kategori' => strtoupper($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah kategori masih digunakan
        $jumlahBarang = $kategori->barangs()->count();

        if ($jumlahBarang > 0) {
            return redirect()
                ->back()
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh ' . $jumlahBarang . ' barang!');
        }

        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
