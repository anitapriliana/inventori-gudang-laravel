<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LAPORAN BARANG MASUK
    |--------------------------------------------------------------------------
    | Default menampilkan data hari ini.
    | Jika filter tanggal dipilih, maka tampil sesuai tanggal filter.
    |
    */

    public function masuk(Request $request)
    {
        $query = BarangMasuk::with('barang');

        // Jika user memilih filter tanggal
        if ($request->filled('tanggal')) {

            $query->whereDate('tanggal', $request->tanggal);
        }

        // Default tampilkan data hari ini
        else {

            $query->whereDate('tanggal', now());
        }

        $data = $query

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('laporan.masuk', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN BARANG KELUAR
    |--------------------------------------------------------------------------
    | Default menampilkan data hari ini.
    | Jika filter tanggal dipilih, maka tampil sesuai tanggal filter.
    |
    */

    public function keluar(Request $request)
    {
        $query = BarangKeluar::with('barang');

        // Jika user memilih filter tanggal
        if ($request->filled('tanggal')) {

            $query->whereDate('tanggal', $request->tanggal);
        }

        // Default tampilkan data hari ini
        else {

            $query->whereDate('tanggal', now());
        }

        $data = $query

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('laporan.keluar', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | CETAK PDF BARANG MASUK
    |--------------------------------------------------------------------------
    */

    public function masukPdf(Request $request)
    {
        $query = BarangMasuk::with('barang');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        } else {
            $query->whereDate('tanggal', now());
        }

        $data = $query->latest()->get();
        $tanggal = $request->tanggal ?? now()->format('Y-m-d');

        $pdf = Pdf::loadView('laporan.pdf.masuk', compact('data', 'tanggal'));

        return $pdf->download('laporan-barang-masuk-' . $tanggal . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | CETAK PDF BARANG KELUAR
    |--------------------------------------------------------------------------
    */

    public function keluarPdf(Request $request)
    {
        $query = BarangKeluar::with('barang');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        } else {
            $query->whereDate('tanggal', now());
        }

        $data = $query->latest()->get();
        $tanggal = $request->tanggal ?? now()->format('Y-m-d');

        $pdf = Pdf::loadView('laporan.pdf.keluar', compact('data', 'tanggal'));

        return $pdf->download('laporan-barang-keluar-' . $tanggal . '.pdf');
    }
}
