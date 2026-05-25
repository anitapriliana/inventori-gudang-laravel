<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Import Facade Pdf secara eksplisit

/**
 * Controller untuk mengelola Laporan Barang Masuk dan Barang Keluar.
 * Lokasi File: app/Http/Controllers/LaporanController.php
 */
class LaporanController extends Controller
{
    /**
     * Halaman Utama Laporan (Redirect ke Laporan Masuk)
     */
    public function index()
    {
        return redirect()->route('laporan.masuk');
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN BARANG MASUK
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan Data Laporan Barang Masuk
     */
    public function masuk(Request $request)
    {
        $query = BarangMasuk::with('barang')
            ->select(
                'barang_id',
                'tanggal',
                DB::raw('SUM(jumlah) as total_jumlah')
            )
            ->groupBy('barang_id', 'tanggal');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        return view('laporan.masuk', compact('data'));
    }

    /**
     * Cetak PDF Laporan Barang Masuk
     */
    public function masukPdf(Request $request)
    {
        $query = BarangMasuk::with('barang')
            ->select(
                'barang_id',
                'tanggal',
                DB::raw('SUM(jumlah) as total_jumlah')
            )
            ->groupBy('barang_id', 'tanggal');

        $tanggal = $request->tanggal;

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $tanggal);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        // Menggunakan Pdf::loadView()
        $pdf = Pdf::loadView('laporan.masuk_pdf', compact('data', 'tanggal'));
        return $pdf->download('laporan-barang-masuk-' . date('Y-m-d') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN BARANG KELUAR
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan Data Laporan Barang Keluar (Grouped per Barang, Proyek & Tanggal)
     */
    public function keluar(Request $request)
    {
        $query = BarangKeluar::with(['barang', 'proyek'])
            ->select(
                'barang_id',
                'proyek_id',
                'tanggal',
                'status',
                DB::raw('SUM(jumlah) as total_jumlah'),
                DB::raw('GROUP_CONCAT(DISTINCT alasan SEPARATOR ", ") as gabungan_alasan')
            )
            ->groupBy('barang_id', 'proyek_id', 'tanggal', 'status');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        return view('laporan.keluar', compact('data'));
    }

    /**
     * Cetak PDF Laporan Barang Keluar
     */
    public function keluarPdf(Request $request)
    {
        $query = BarangKeluar::with(['barang', 'proyek'])
            ->select(
                'barang_id',
                'proyek_id',
                'tanggal',
                'status',
                DB::raw('SUM(jumlah) as total_jumlah'),
                DB::raw('GROUP_CONCAT(DISTINCT alasan SEPARATOR ", ") as gabungan_alasan')
            )
            ->groupBy('barang_id', 'proyek_id', 'tanggal', 'status');

        $tanggal = $request->tanggal;

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $tanggal);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        // Menggunakan Pdf::loadView()
        $pdf = Pdf::loadView('laporan.keluar_pdf', compact('data', 'tanggal'));
        return $pdf->download('laporan-barang-keluar-' . date('Y-m-d') . '.pdf');
    }
}
