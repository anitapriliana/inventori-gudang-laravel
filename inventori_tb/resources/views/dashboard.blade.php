@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    
    {{-- WELCOME HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    </div>

    {{-- MAIN STATISTICS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-center">
        
        {{-- Total Barang --}}
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Barang</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalBarang }}</p>
                    <p class="text-blue-100 text-xs mt-1">jenis barang</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Stok Rendah --}}
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Stok Rendah</p>
                    <p class="text-3xl font-bold mt-2">{{ $stokRendah }}</p>
                    <p class="text-yellow-100 text-xs mt-1">perlu restock</p>
                </div>
                <div class="bg-yellow-400 bg-opacity-30 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Stok Habis --}}
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Stok Habis</p>
                    <p class="text-3xl font-bold mt-2">{{ $stokHabis }}</p>
                    <p class="text-red-100 text-xs mt-1">butuh restock</p>
                </div>
                <div class="bg-red-400 bg-opacity-30 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- CHART SECTION --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Barang Masuk & Keluar (7 Hari Terakhir)</h3>
        <canvas id="chartBarangMasukKeluar" height="80"></canvas>
    </div>
</div>

{{-- CHART.JS LIBRARY --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari controller (convert ke JSON)
    const chartData = @json($chartData);
    
    // Setup chart
    const ctx = document.getElementById('chartBarangMasukKeluar').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels, // ['2024-02-10', '2024-02-11', ...]
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: chartData.masuk, // [5, 8, 3, ...]
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Barang Keluar',
                    data: chartData.keluar, // [3, 6, 4, ...]
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection