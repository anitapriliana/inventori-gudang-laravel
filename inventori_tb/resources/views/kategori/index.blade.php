@extends('layouts.app')

@section('title', 'Kategori Barang')

@section('content')
    <div class="space-y-6">

        {{-- Header halaman --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kategori Barang</h1>
                <p class="text-gray-600 mt-1">Kelola kategori untuk klasifikasi barang</p>
            </div>

            {{-- Tombol tambah kategori --}}
            <a href="{{ route('kategori.create') }}"
                class="inline-flex items-center bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
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
                                Kode Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Nama Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Jumlah Barang
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    {{-- Isi tabel --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($kategoris as $index => $item)
                            <tr class="hover:bg-purple-50/50 transition-colors duration-150">

                                {{-- Nomor --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-700">
                                    {{ $kategoris->firstItem() + $loop->index }}
                                </td>

                                {{-- Kode kategori --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-purple-600">
                                    {{ $item->kode_kategori }}
                                </td>

                                {{-- Nama kategori --}}
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                    {{ $item->nama_kategori }}
                                </td>

                                {{-- Deskripsi --}}
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $item->deskripsi ?? '-' }}
                                </td>

                                {{-- Jumlah barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        {{ $item->barangs->count() }} barang
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">

                                        <a href="{{ route('kategori.edit', $item->id) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-white hover:bg-blue-600 bg-blue-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow"
                                            title="Edit kategori">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Form untuk hapus kategori --}}
                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus kategori {{ addslashes($item->nama_kategori) }}?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-white hover:bg-red-600 bg-red-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow"
                                                title="Hapus kategori">
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
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-700 mb-1">Belum ada kategori</h3>
                                        <p class="text-gray-500 text-sm">Tambahkan kategori untuk mengklasifikasi barang.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($kategoris->hasPages())
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <p class="text-sm text-gray-600 text-center lg:text-left font-medium">
                        Menampilkan <span class="font-bold text-gray-800">{{ $kategoris->firstItem() }}</span> -
                        <span class="font-bold text-gray-800">{{ $kategoris->lastItem() }}</span> dari
                        <span class="font-bold text-gray-800">{{ $kategoris->total() }}</span> kategori
                    </p>

                    <div class="w-full lg:w-auto overflow-x-auto">
                        {{ $kategoris->links() }}
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
