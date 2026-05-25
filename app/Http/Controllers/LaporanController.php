<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Controller untuk mengelola Laporan Barang Masuk dan Barang Keluar.
 * Dokumentasi: Mengubah method get() menjadi paginate() pada tampilan web.
 * Terminal Tujuan: Tidak ada (File Controller Backend)
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

        // Menggunakan paginate() agar mendukung pagination Blade & filter query string
        $data = $query->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('laporan.masuk', compact('data'));
    }

    /**
     * Cetak PDF Laporan Barang Masuk (Tetap get() agar mencetak seluruh data)
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

        $pdf = Pdf::loadView('laporan.masuk_pdf', compact('data', 'tanggal'));
        return $pdf->download('laporan-barang-masuk-' . date('Y-m-d') . '.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN BARANG KELUAR
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan Data Laporan Barang Keluar (satu baris per Barang & Tanggal,
     * rincian proyek + jumlahnya ada di $item->rincian)
     */
    public function keluar(Request $request)
    {
        $data = $this->ambilLaporanKeluar($request, true);

        return view('laporan.keluar', compact('data'));
    }

    /**
     * Cetak PDF Laporan Barang Keluar (Tetap get() agar mencetak seluruh data)
     */
    public function keluarPdf(Request $request)
    {
        $tanggal = $request->tanggal;

        $data = $this->ambilLaporanKeluar($request, false);

        $pdf = Pdf::loadView('laporan.keluar_pdf', compact('data', 'tanggal'));
        return $pdf->download('laporan-barang-keluar-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Ambil laporan barang keluar yang digabung per barang + tanggal + status.
     * Tiap baris punya relasi "rincian" (jumlah per proyek), "total_jumlah",
     * dan "gabungan_alasan".
     *
     * @param Request $request
     * @param bool $paginate true = paginate(10) buat web, false = get() buat PDF
     */
    private function ambilLaporanKeluar(Request $request, bool $paginate)
    {
        // 1. Daftar baris laporan (unik per barang + tanggal + status), inilah yang dipaginasi
        $query = BarangKeluar::with('barang')
            ->select('barang_id', 'tanggal', 'status')
            ->groupBy('barang_id', 'tanggal', 'status')
            ->orderBy('tanggal', 'desc')
            ->orderBy('barang_id');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $data = $paginate
            ? $query->paginate(10)->withQueryString()
            : $query->get();

        $grup = $paginate ? $data->getCollection() : $data;

        if ($grup->isEmpty()) {
            return $data;
        }

        // 2. Ambil rincian per proyek, hanya untuk baris yang tampil di halaman ini
        $rincian = BarangKeluar::with('proyek')
            ->select(
                'barang_id',
                'proyek_id',
                'tanggal',
                'status',
                DB::raw('SUM(jumlah) as total_jumlah'),
                DB::raw('GROUP_CONCAT(DISTINCT alasan SEPARATOR ", ") as gabungan_alasan')
            )
            ->where(function ($q) use ($grup) {
                foreach ($grup as $g) {
                    $q->orWhere(function ($w) use ($g) {
                        $w->where('barang_id', $g->barang_id)
                            ->whereDate('tanggal', $g->tanggal)
                            ->where('status', $g->status);
                    });
                }
            })
            ->groupBy('barang_id', 'proyek_id', 'tanggal', 'status')
            ->get();

        // 3. Pasangkan rincian ke tiap baris lewat kunci barang|tanggal|status
        $kunci = fn($r) => $r->barang_id . '|' . Carbon::parse($r->tanggal)->toDateString() . '|' . $r->status;
        $perKunci = $rincian->groupBy($kunci);

        $grup->each(function ($g) use ($perKunci, $kunci) {
            $items = $perKunci->get($kunci($g), collect())
                ->sortBy(fn($r) => $r->proyek->nama_proyek ?? '')
                ->values();

            $g->setRelation('rincian', $items);
            $g->total_jumlah = $items->sum('total_jumlah');
            $g->gabungan_alasan = $items->pluck('gabungan_alasan')->filter()->unique()->implode(', ');
        });

        return $data;
    }
}
