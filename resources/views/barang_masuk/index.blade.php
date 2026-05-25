{{-- HALAMAN INDEX BARANG MASUK --}}

@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
    <div class="space-y-6">

        {{-- header halaman --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Barang Masuk</h1>
                <p class="text-slate-500 mt-1 text-sm">
                    Kelola transaksi barang masuk dan lihat riwayat data terbaru.
                </p>
            </div>

            {{-- tombol tambah stok sebagai aksi utama --}}
            {{-- File View Blade --}}
            @if (Auth::user()->role === 'admin_gudang')
                {{-- Container pembungkus dengan gap yang bisa diatur (gap-2 = 0.5rem / 8px, gap-3 = 0.75rem / 12px) --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('barang-masuk.create') }}"
                        class="inline-flex items-center bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Stok
                    </a>
                    <a href="{{ route('barang-masuk.return.create') }}"
                        class="inline-flex items-center bg-amber-700 hover:bg-amber-800 text-white font-medium py-2.5 px-5 rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        Retur Barang
                    </a>
                </div>
            @endif
        </div>


        {{-- pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-2 border-green-600 p-4 rounded-lg animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-600 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>

                        <div>
                            <p class="font-semibold text-green-800">Berhasil!</p>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>

                    {{-- tombol untuk menutup alert secara manual --}}
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-green-600 hover:text-green-800 ml-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- pesan error --}}
        @if (session('error'))
            <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-700 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 001.414 1.414L8.586 10l1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L10 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>

                        <div>
                            <p class="font-semibold text-red-800">Error!</p>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>

                    {{-- tombol untuk menutup alert secara manual --}}
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-700 hover:text-red-900 ml-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- pesan error validasi form --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg animate-fade-in" role="alert">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-700 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-semibold text-red-800 mb-2">Terjadi kesalahan!</p>
                        <ul class="list-disc list-inside text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif


        {{-- tabel data barang masuk --}}
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">

                    {{-- header tabel --}}
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

                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Jumlah
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Tanggal
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    {{-- isi tabel --}}
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($data as $index => $item)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">

                                {{-- nomor urut --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500 tabular-nums">
                                    {{ $data->firstItem() + $loop->index }}
                                </td>

                                {{-- kode barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-700">
                                    {{ $item->barang->kode_barang ?? '-' }}
                                </td>

                                {{-- nama barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-700">
                                    {{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                </td>

                                {{-- merk --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $item->barang->merk ?? '-' }}
                                </td>

                                {{-- jumlah barang yang masuk --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 tabular-nums">
                                        {{ $item->jumlah }} {{ $item->barang->satuan ?? '-' }}
                                    </span>
                                </td>

                                {{-- tanggal transaksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </td>

                                {{-- aksi hapus --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- form hapus transaksi barang masuk --}}
                                        <form action="{{ route('barang-masuk.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus data barang masuk ini?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 text-red-600 border border-red-200 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg transition-colors duration-150"
                                                title="Hapus data">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M3 7h18m-7 0V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v3" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            {{-- tampilan ketika belum ada data --}}
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">

                                        <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m6 0v2m4-2v2" />
                                        </svg>

                                        <h3 class="text-lg font-semibold text-slate-700 mb-1">
                                            Belum ada barang masuk
                                        </h3>

                                        <p class="text-slate-500 text-sm">
                                            Tambahkan transaksi barang masuk untuk memulai.
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
                // biar filter search & kategori kebawa pas pindah halaman
                $data->withQueryString();

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

    @push('styles')
        <style>
            /* animasi alert ketika muncul */
            @keyframes fade-in {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fade-in 0.3s ease-out;
            }

            /* custom scrollbar untuk tabel */
            .overflow-x-auto::-webkit-scrollbar {
                height: 8px;
            }

            .overflow-x-auto::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb {
                background: #cbd5e0;
                border-radius: 10px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb:hover {
                background: #a0aec0;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Alert otomatis hilang setelah 5 detik.
                document.querySelectorAll('[role="alert"]').forEach(alert => {
                    setTimeout(() => {
                        alert.style.transition = 'opacity 0.5s';
                        alert.style.opacity = '0';

                        setTimeout(() => alert.remove(), 500);
                    }, 5000);
                });

            });
        </script>
    @endpush

@endsection
