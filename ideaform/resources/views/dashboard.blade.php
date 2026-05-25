@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- header --}}
        <div class="flex items-baseline justify-between border-b border-slate-200 pb-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Dashboard Gudang</h1>
                <p class="text-sm text-slate-500 mt-1">Ringkasan kondisi stok hari ini</p>
            </div>
            <p class="text-sm text-slate-400 tabular-nums">{{ now()->translatedFormat('d F Y') }}</p>
        </div>

        {{-- STOCK OVERVIEW — one bordered panel divided into sections, each tagged
         with a colored accent bar instead of separate gradient cards --}}
        <div class="bg-white border border-slate-200 rounded-lg overflow-hidden">
            <div class="flex flex-col sm:flex-row divide-y sm:divide-y-0 sm:divide-x divide-slate-200">

                {{-- total barang --}}
                <div class="relative flex-1 pl-5 pr-6 py-6">
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-slate-700" aria-hidden="true"></span>
                    <p class="text-sm text-slate-500">Total Barang</p>
                    <p class="text-4xl font-semibold text-slate-900 tabular-nums mt-2">{{ $totalBarang }}</p>
                    <p class="text-xs text-slate-400 mt-1">jenis barang terdaftar</p>
                </div>

                {{-- stok habis --}}
                <div class="relative flex-1 pl-5 pr-6 py-6">
                    <span class="absolute left-0 top-0 bottom-0 w-1 bg-red-700" aria-hidden="true"></span>
                    <p class="text-sm text-slate-500">Stok Habis</p>
                    <p class="text-4xl font-semibold text-red-700 tabular-nums mt-2">{{ $stokHabis }}</p>
                    <p class="text-xs text-slate-400 mt-1">tidak tersedia sama sekali</p>
                </div>

            </div>
        </div>

        {{-- CHART SECTION — flat panel with hairline border instead of shadow-lg + rounded-xl --}}
        <div class="bg-white border border-slate-200 rounded-lg p-6">
            <div class="flex items-baseline justify-between mb-4">
                <h3 class="text-base font-semibold text-slate-800">Barang Masuk &amp; Keluar</h3>
                <span class="text-xs text-slate-400">7 hari terakhir</span>
            </div>
            <canvas id="chartBarangMasukKeluar" height="80"></canvas>
        </div>

    </div>

    {{-- CHART.JS LIBRARY --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // data dari controller (convert ke JSON)
            const chartData = @json($chartData);

            const ctx = document.getElementById('chartBarangMasukKeluar').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels, // ['2024-02-10', '2024-02-11', ...]
                    datasets: [{
                            label: 'Barang Masuk',
                            data: chartData.masuk, // [5, 8, 3, ...]
                            borderColor: '#3F7D53',
                            backgroundColor: 'rgba(63, 125, 83, 0.08)',
                            borderWidth: 2,
                            pointRadius: 3,
                            pointBackgroundColor: '#3F7D53',
                            tension: 0.35
                        },
                        {
                            label: 'Barang Keluar',
                            data: chartData.keluar, // [3, 6, 4, ...]
                            borderColor: '#A6432E',
                            backgroundColor: 'rgba(166, 67, 46, 0.08)',
                            borderWidth: 2,
                            pointRadius: 3,
                            pointBackgroundColor: '#A6432E',
                            tension: 0.35
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: {
                                boxWidth: 10,
                                boxHeight: 10,
                                usePointStyle: true,
                                color: '#475569',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: '#1C2530',
                            padding: 10,
                            cornerRadius: 4
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#94A3B8',
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#EEF1F4'
                            },
                            ticks: {
                                stepSize: 1,
                                color: '#94A3B8',
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
