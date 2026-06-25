{{-- HALAMAN INDEX BARANG MASUK --}}

@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
    <div class="space-y-6">

        {{-- Header halaman --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Barang Masuk</h1>
                <p class="text-gray-600 mt-1">Kelola transaksi barang masuk dan lihat riwayat data terbaru.</p>
            </div>

            {{-- Form tambah transaksi barang masuk --}}
            <a href="{{ route('barang-masuk.create') }}"
                class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Stok
            </a>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>

                    {{-- Tombol X untuk menutup alert secara manual --}}
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
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
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Tabel data barang masuk --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            {{-- Header tabel --}}
            <div
                class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Riwayat Barang Masuk Terbaru</h2>
                    <p class="text-gray-600 mt-1">Menampilkan data transaksi barang masuk terbaru</p>
                </div>
            </div>

            {{-- Wrapper overflow-x-auto agar tabel bisa di-scroll horizontal di layar kecil --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-black uppercase">No.</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-black uppercase">Nama Barang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-black uppercase">Merk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-black uppercase">Jumlah</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-black uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-black uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- @forelse dipakai agar bisa menangani kondisi data kosong via @empty --}}
                        @forelse($data as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">

                                {{-- Nomor urut — dihitung dari index loop (0-based) + 1 --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Nama Barang --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Merk --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item->barang->merk ?? '-' }}
                                </td>

                                {{-- Jumlah --}}
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }}
                                    {{ $item->barang->satuan ?? '-' }}</td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                    {{ date('d/m/Y', strtotime($item->tanggal)) }}
                                </td>

                                {{-- Hapus --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('barang-masuk.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- EMPTY STATE — ditampilkan jika $data tidak punya record sama sekali --}}
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada data</h3>
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
            /* Animasi muncul dari atas untuk alert success */
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

    @push('scripts')
        <script>
            // Auto-hide alert pertama yang ditemukan setelah 5 detik dengan efek fade-out 0.5 detik.
            // Catatan: hanya menyasar satu alert — jika ada success dan error sekaligus,
            // hanya yang pertama di DOM yang akan hilang otomatis.
            setTimeout(() => {
                const alert = document.querySelector('[role="alert"]');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        </script>
    @endpush
@endsection
