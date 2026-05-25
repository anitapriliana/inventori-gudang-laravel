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
                    <input type="text" name="tanggal" id="filter_tanggal" value="{{ request('tanggal') }}"
                        placeholder="Pilih tanggal..."
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

                                {{-- nomor (lanjut antar halaman) --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500 tabular-nums">
                                    {{ $data->firstItem() + $loop->index }}
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
                                    {{ floatval($d->total_jumlah ?? $d->jumlah) }} {{ $d->barang->satuan ?? '-' }}
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

        {{-- pagination (di luar tabel, rata tengah) --}}
        @if ($data->hasPages())
            @php
                // memastikan query string (seperti filter tanggal) tetap terbawa
                $data->appends(request()->query());

                // class tombol, disalin persis dari desain lo
                $btnPrev =
                    'rounded-full border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2';
                $btnNext =
                    'min-w-9 rounded-full border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2';
                $btnAngka =
                    'min-w-9 rounded-full border border-slate-300 py-2 px-3.5 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2';
                $btnAktif =
                    'min-w-9 rounded-full bg-slate-800 py-2 px-3.5 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2';

                // tampilkan maksimal 5 nomor di sekitar halaman aktif
                $awal = max(1, $data->currentPage() - 2);
                $akhir = min($data->lastPage(), $data->currentPage() + 2);
            @endphp

            <nav role="navigation" aria-label="Pagination" class="flex justify-center">
                <div class="flex space-x-1">

                    {{-- prev (di halaman pertama jadi button disabled) --}}
                    @if ($data->onFirstPage())
                        <button type="button" disabled class="{{ $btnPrev }}">Prev</button>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" class="{{ $btnPrev }}">Prev</a>
                    @endif

                    {{-- nomor halaman --}}
                    @for ($i = $awal; $i <= $akhir; $i++)
                        @if ($i == $data->currentPage())
                            <span aria-current="page" class="{{ $btnAktif }}">{{ $i }}</span>
                        @else
                            <a href="{{ $data->url($i) }}" class="{{ $btnAngka }}">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- next (di halaman terakhir jadi button disabled) --}}
                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}" class="{{ $btnNext }}">Next</a>
                    @else
                        <button type="button" disabled class="{{ $btnNext }}">Next</button>
                    @endif
                </div>
            </nav>
        @endif
    </div>

    @push('scripts')
        {{-- flatpickr css & js --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            // datepicker filter: tampil d/m/Y, kirim Y-m-d, auto submit saat dipilih
            flatpickr("#filter_tanggal", {
                altInput: true,
                altFormat: "d/m/Y",
                dateFormat: "Y-m-d",
                defaultDate: "{{ request('tanggal') }}" || null,
                altInputClass: "w-full sm:w-auto px-4 py-2.5 text-sm text-slate-700 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150",
                onChange: function(selectedDates, dateStr, instance) {
                    instance.input.form.submit();
                }
            });
        </script>
    @endpush
@endsection
