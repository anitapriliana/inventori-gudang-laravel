{{-- halaman laporan barang masuk --}}

@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
    <div class="space-y-6">

        {{-- header --}}
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Laporan Barang Masuk</h1>
            <p class="text-slate-500 mt-1 text-sm">Menampilkan data barang masuk</p>
        </div>

        <form method="GET" action="{{ route('laporan.masuk') }}">
            <div class="flex flex-col md:flex-row gap-3 items-end">

                {{-- filter tanggal --}}
                <div class="w-full sm:w-auto">
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Filter Tanggal
                    </label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()"
                        class="w-full sm:w-auto px-4 py-2.5 text-sm text-slate-700 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150">
                </div>

                {{-- tombol cetak PDF --}}
                <a href="{{ route('laporan.masuk.pdf', ['tanggal' => request('tanggal')]) }}"
                    class="inline-flex items-center bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Cetak PDF
                </a>

            </div>
        </form>

        {{-- tabel data --}}
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">

                    {{-- header --}}
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kode Barang
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Nama Barang
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Merk
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Jumlah
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                        </tr>
                    </thead>

                    {{-- body tabel --}}
                    <tbody class="bg-white divide-y divide-slate-200">

                        {{-- @forelse dipakai agar bisa menangani kondisi data kosong via @empty --}}
                        @forelse($data as $index => $d)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">

                                {{-- nomor --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500 tabular-nums">
                                    {{ $index + 1 }}
                                </td>

                                {{-- kode barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-500">
                                    {{ $d->barang->kode_barang ?? '-' }}
                                </td>

                                {{-- nama barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-700">
                                    {{ $d->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                </td>

                                {{-- merk --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $d->barang->merk ?? '-' }}
                                </td>

                                {{-- jumlah + satuan --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-slate-500 tabular-nums">
                                    {{ $d->jumlah }} {{ $d->barang->satuan ?? '-' }}
                                </td>

                                {{-- tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500">
                                    {{ date('d-m-Y', strtotime($d->tanggal)) }}
                                </td>

                            </tr>

                            {{-- EMPTY STATE — ditampilkan jika tidak ada data --}}
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m6 0v2m4-2v2" />
                                        </svg>
                                        <h3 class="text-lg font-semibold text-slate-700 mb-1">
                                            Data tidak ditemukan
                                        </h3>
                                        <p class="text-slate-500 text-sm">
                                            Belum ada data barang masuk untuk filter ini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
