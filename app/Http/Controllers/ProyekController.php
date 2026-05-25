<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
     * menampilkan detail 1 proyek + barang keluar yang dikelompokkan
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        // with('barangKeluar.barang') = ambil sekalian data barang_keluar
        // dan relasi barang di dalamnya
        $proyek = Proyek::with('barangKeluar.barang')->findOrFail($id);

        // Mengelompokkan barang keluar berdasarkan kombinasi barang_id dan tanggal
        $groupedBarangKeluar = $proyek->barangKeluar
            ->groupBy(function ($item) {
                return $item->barang_id . '_' . Carbon::parse($item->tanggal)->format('Y-m-d');
            })
            ->map(function ($group) {
                // Ambil data item pertama dari kelompok
                $firstItem = clone $group->first();
                // Jumlahkan total qty (jumlah) untuk barang yang sama di tanggal yang sama
                $firstItem->jumlah = $group->sum('jumlah');
                return $firstItem;
            })
            ->values();

        return view('proyek.show', compact('proyek', 'groupedBarangKeluar'));
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
