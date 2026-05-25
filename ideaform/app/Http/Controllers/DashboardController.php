<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display dashboard dengan semua statistik dan overview
     */
    public function index()
    {
        // ===== STATISTICS CARDS =====

        // Total jenis barang
        $totalBarang = Barang::count();

        // Total stok semua barang
        $totalStok = Barang::sum('stok');

        // Barang dengan stok rendah (< 10 unit)
        $stokRendah = Barang::where('stok', '<', 10)->where('stok', '>', 0)->count();

        // Barang dengan stok habis (= 0)
        $stokHabis = Barang::where('stok', 0)->count();


        // ===== ACTIVITY TODAY =====

        // Barang masuk hari ini
        $barangMasukHariIni = BarangMasuk::whereDate('tanggal', Carbon::today())->count();

        // Barang keluar hari ini
        $barangKeluarHariIni = BarangKeluar::whereDate('tanggal', Carbon::today())->count();


        // ===== ALERT STOK RENDAH =====

        // 5 barang dengan stok terendah
        $barangStokRendah = Barang::where('stok', '<', 10)
            ->orderBy('stok', 'asc')
            ->limit(5)
            ->get();


        // ===== AKTIVITAS TERBARU =====

        // Gabungkan barang masuk & keluar, ambil 10 terakhir
        $barangMasuk = BarangMasuk::with('barang')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $item->tipe = 'masuk';
                return $item;
            });

        $barangKeluar = BarangKeluar::with('barang')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $item->tipe = 'keluar';
                return $item;
            });

        // Gabung & sort by tanggal
        $aktivitasTerbaru = $barangMasuk->merge($barangKeluar)
            ->sortByDesc('tanggal')
            ->take(10);


        // ===== CHART DATA (7 Hari Terakhir) =====

        $chartData = $this->getChartData();


        // Return ke view
        return view('dashboard', compact(
            'totalBarang',
            'totalStok',
            'stokRendah',
            'stokHabis',
            'barangMasukHariIni',
            'barangKeluarHariIni',
            'barangStokRendah',
            'aktivitasTerbaru',
            'chartData'
        ));
    }

    /**
     * Generate data untuk chart (7 hari terakhir)
     */
    private function getChartData()
    {
        $labels = [];
        $dataMasuk = [];
        $dataKeluar = [];

        // Loop 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            // Label tanggal (format: '15 Feb')
            $labels[] = $date->format('d M');

            // Hitung total barang masuk di tanggal ini
            $masuk = BarangMasuk::whereDate('tanggal', $date)->count();
            $dataMasuk[] = $masuk;

            // Hitung total barang keluar di tanggal ini
            $keluar = BarangKeluar::whereDate('tanggal', $date)->count();
            $dataKeluar[] = $keluar;
        }

        return [
            'labels' => $labels,     // ['9 Feb', '10 Feb', ...]
            'masuk' => $dataMasuk,   // [5, 8, 3, ...]
            'keluar' => $dataKeluar, // [3, 6, 4, ...]
        ];
    }
}
