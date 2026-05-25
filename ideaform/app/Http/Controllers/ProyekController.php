<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * menampilkan daftar proyek
     */
    public function index()
    {
        $proyeks = Proyek::latest()->get();
        return view('proyek.index', compact('proyeks'));
    }

    /**
     * menampilkan form untuk menambah proyek baru
     */
    public function create()
    {
        return view('proyek.create');
    }

    /**
     * simpan proyek baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        Proyek::create($request->all());

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    /**
     * menampilkan detail 1 proyek + barang keluar yang terkait
     */
    public function show(string $id)
    {
        // with('barangKeluar.barang') = ambil sekalian data barang_keluar
        // dan relasi barang di dalamnya, biar gak query berkali-kali
        $proyek = Proyek::with('barangKeluar.barang')->findOrFail($id);

        return view('proyek.show', compact('proyek'));
    }

    /**
     * menampilkan form untuk mengedit proyek
     */
    public function edit(string $id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('proyek.edit', compact('proyek'));
    }

    /**
     * update data proyek
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $proyek = Proyek::findOrFail($id);
        $proyek->update($request->all());

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil diupdate.');
    }

    /**
     * hapus proyek
     */
    public function destroy(string $id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->delete();

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
