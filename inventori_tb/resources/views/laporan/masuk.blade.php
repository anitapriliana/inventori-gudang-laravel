{{-- HALAMAN LAPORAN BARANG MASUK --}}

@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Laporan Barang Masuk</h1>
            <p class="text-gray-600 mt-1">Menampilkan data barang masuk</p>
        </div>

        {{--
        |--------------------------------------------------------------------------
        | FILTER TANGGAL & TOMBOL CETAK PDF
        |--------------------------------------------------------------------------
        | - Filter menggunakan method GET supaya parameter muncul di URL
        | - Auto submit saat tanggal berubah
        | - Tombol cetak PDF akan meneruskan parameter tanggal yang aktif
        |--------------------------------------------------------------------------
        --}}
        <form method="GET" action="{{ route('laporan.masuk') }}">
            <div class="flex flex-col md:flex-row gap-4 items-end">

                {{-- Filter Tanggal --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Filter Tanggal
                    </label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                </div>

                {{--
                | Tombol Cetak PDF
                | - Meneruskan parameter tanggal yang sedang aktif ke route PDF
                | - Jika tidak ada filter, otomatis pakai tanggal hari ini (ditangani controller)
                --}}
                <a href="{{ route('laporan.masuk.pdf', ['tanggal' => request('tanggal')]) }}"
                    class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Cetak PDF
                </a>

            </div>
        </form>

        {{-- Tabel Data Barang Masuk --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    {{-- HEADER TABEL --}}
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Merk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        </tr>
                    </thead>

                    {{-- BODY TABEL --}}
                    <tbody class="bg-white divide-y divide-gray-200">

                        {{-- @forelse dipakai agar bisa menangani kondisi data kosong via @empty --}}
                        @forelse($data as $index => $d)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">

                                {{-- Nomor urut --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Nama Barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    {{ $d->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                </td>

                                {{-- Merk --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $d->barang->merk ?? '-' }}
                                </td>

                                {{-- Jumlah + Satuan --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $d->jumlah }} {{ $d->barang->satuan ?? '-' }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ date('d/m/Y', strtotime($d->tanggal)) }}
                                </td>

                            </tr>

                            {{-- EMPTY STATE — ditampilkan jika tidak ada data --}}
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <h3 class="text-lg font-semibold text-gray-700">Data tidak ditemukan</h3>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
