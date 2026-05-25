{{-- halaman detail proyek --}}

@extends('layouts.app')

@section('title', $proyek->nama_proyek)

@section('content')
    <div class="space-y-6">

        {{-- header halaman --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('proyek.index') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded-lg -ml-3 mb-3 transition-all duration-150 group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transition-transform duration-150 group-hover:-translate-x-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Proyek
                </a>
                <h1 class="text-3xl font-bold text-gray-800">{{ $proyek->nama_proyek }}</h1>
                <p class="text-gray-600 mt-1 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $proyek->lokasi ?? 'Lokasi tidak diisi' }}
                </p>
            </div>
        </div>

        {{-- pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm animate-fade-in" role="alert">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        {{-- tabel bahan/barang keluar untuk proyek ini --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Bahan Keluar untuk Proyek Ini</h2>
                    <p class="text-gray-500 text-sm mt-1">Data diambil otomatis dari transaksi Barang Keluar</p>
                </div>
                <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Barang
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Merk
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jumlah
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- $proyek->barangKeluar berasal dari relasi hasMany di Model Proyek --}}
                        @forelse($proyek->barangKeluar as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    {{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item->barang->merk ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->jumlah }} {{ $item->barang->satuan ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ date('d/m/Y', strtotime($item->tanggal)) }}
                                </td>

                                {{-- keterangan --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item->keterangan ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-1">
                                        Belum ada bahan keluar untuk proyek ini
                                    </h3>
                                    <p class="text-gray-500 text-sm">
                                        Transaksi barang keluar yang terhubung ke proyek ini akan muncul di sini
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @keyframes fade-in {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fade-in 0.3s ease-out;
            }
        </style>
    @endpush
@endsection
