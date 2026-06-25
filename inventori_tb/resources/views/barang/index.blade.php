@extends('layouts.app')

@section('title', 'Stok Barang')

@section('content')
    <div class="space-y-6">

        {{-- Header halaman --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Stok Barang</h1>
                <p class="text-gray-600 mt-1">Kelola semua data stok barang di gudang</p>
            </div>

            {{-- Tombol tambah barang baru --}}
            <a href="{{ route('barang.create') }}"
                class="inline-flex items-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Barang Baru
            </a>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-green-800">Berhasil!</p>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-green-500 hover:text-green-700 ml-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- Pesan error --}}
        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-red-800">Error!</p>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-500 hover:text-red-700 ml-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- Search Bar dan Filter Kategori --}}
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            {{-- Search Bar --}}
            <form action="{{ route('barang.index') }}" method="GET" class="flex-1 sm:max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                        onchange="this.form.submit()"
                        class="w-full pl-10 pr-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 shadow-sm hover:shadow">
                </div>
            </form>

            {{-- Filter Kategori --}}
            <form method="GET" action="{{ route('barang.index') }}" class="sm:w-auto">
                <div class="relative">
                    <select name="kategori" onchange="this.form.submit()"
                        class="appearance-none w-full sm:w-auto pl-4 pr-10 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 shadow-sm hover:shadow cursor-pointer">
                        <option value="">Semua Kategori</option>

                        @foreach ($kategoris as $k)
                            <option value="{{ $k->nama_kategori }}"
                                {{ request('kategori') == $k->nama_kategori ? 'selected' : '' }}>

                                {{ $k->nama_kategori }}

                            </option>
                        @endforeach
                        </option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    {{-- Header tabel --}}
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                No.
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Kode Barang
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Nama Barang
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Merk
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Stok
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Satuan
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    {{-- Isi tabel --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($barang as $index => $item)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-150">

                                {{-- Nomor --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-700">
                                    {{ $barang->firstItem() + $loop->index }}
                                </td>

                                {{-- Kode barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600">
                                    {{ $item->kode_barang ?? '-' }}
                                </td>

                                {{-- Nama barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600">
                                    {{ $item->nama_barang }}
                                </td>

                                {{-- Merk --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-600">
                                    {{ $item->merk ?? '-' }}
                                </td>

                                {{-- Keterangan stok --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($item->stok == 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-gray-600">
                                            Habis
                                        </span>
                                    @elseif($item->stok <= 5)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-gray-600">
                                            {{ $item->stok }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-gray-600">
                                            {{ $item->stok }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Satuan --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                                    {{ $item->satuan ?? '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">

                                        <a href="{{ route('barang.edit', ['barang' => $item->id, 'page' => request('page')]) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-white hover:bg-blue-600 bg-blue-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow"
                                            title="Edit barang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Form untuk hapus barang --}}
                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus barang {{ addslashes($item->nama_barang) }}?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-white hover:bg-red-600 bg-red-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow"
                                                title="Hapus barang">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-700 mb-1">
                                            {{ request('search') ? 'Barang tidak ditemukan' : 'Belum ada data barang' }}
                                        </h3>
                                        <p class="text-gray-500 text-sm">
                                            {{ request('search') ? 'Coba kata kunci lain atau reset pencarian.' : 'Tambahkan barang ke dalam stok gudang.' }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($barang->hasPages())
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <p class="text-sm text-gray-600 text-center lg:text-left font-medium">
                        Menampilkan <span class="font-bold text-gray-800">{{ $barang->firstItem() }}</span> -
                        <span class="font-bold text-gray-800">{{ $barang->lastItem() }}</span> dari
                        <span class="font-bold text-gray-800">{{ $barang->total() }}</span> barang
                    </p>

                    <div class="w-full lg:w-auto overflow-x-auto">
                        <nav class="flex items-center gap-2 min-w-max">

                            @if ($barang->onFirstPage())
                                <span
                                    class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                    &laquo; Prev
                                </span>
                            @else
                                <a href="{{ $barang->previousPageUrl() }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-150 shadow-sm hover:shadow">
                                    &laquo; Prev
                                </a>
                            @endif

                            @php
                                $start = max($barang->currentPage() - 2, 1);
                                $end = min($barang->currentPage() + 2, $barang->lastPage());
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $barang->url(1) }}"
                                    class="w-10 h-10 flex items-center justify-center text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-150 shadow-sm hover:shadow">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-2 text-sm text-gray-400">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $barang->currentPage())
                                    <span
                                        class="w-10 h-10 flex items-center justify-center text-sm font-bold bg-gradient-to-r from-blue-600 to-blue-700 text-white border border-blue-600 rounded-lg shadow-md">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $barang->url($page) }}"
                                        class="w-10 h-10 flex items-center justify-center text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-150 shadow-sm hover:shadow">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if ($end < $barang->lastPage())
                                @if ($end < $barang->lastPage() - 1)
                                    <span class="px-2 text-sm text-gray-400">...</span>
                                @endif
                                <a href="{{ $barang->url($barang->lastPage()) }}"
                                    class="w-10 h-10 flex items-center justify-center text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-150 shadow-sm hover:shadow">
                                    {{ $barang->lastPage() }}
                                </a>
                            @endif

                            @if ($barang->hasMorePages())
                                <a href="{{ $barang->nextPageUrl() }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-150 shadow-sm hover:shadow">
                                    Next &raquo;
                                </a>
                            @else
                                <span
                                    class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                    Next &raquo;
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            @endif
        </div>

    </div>

    @push('styles')
        <style>
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

            /* Custom scrollbar untuk tabel */
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
                // Auto dismiss alerts
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
