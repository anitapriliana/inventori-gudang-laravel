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

        {{-- pesan error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" role="alert">
                <ul class="list-disc list-inside text-red-700 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- tabel bahan/barang keluar untuk proyek ini --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Bahan Keluar untuk Proyek Ini</h2>
                    <p class="text-gray-500 text-sm mt-1">Data diambil otomatis dari transaksi Barang Keluar</p>
                </div>
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
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($groupedBarangKeluar ?? $proyek->barangKeluar as $index =>$item)
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

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item->keterangan ?? '-' }}
                                </td>

                                {{-- Tombol Pengembalian ke Gudang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <button type="button"
                                        onclick="openModal('{{ $item->id }}', '{{ $item->barang->nama_barang ?? 'Barang' }}', {{ $item->jumlah }})"
                                        class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-lg transition-colors duration-150">
                                        Kembalikan ke Gudang
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
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

    {{-- Modal Form Kembalikan Sisa Barang --}}
    <div id="modalKembali" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 space-y-4">
            <h3 class="text-lg font-bold text-slate-800">Kembalikan Sisa Bahan ke Gudang</h3>
            <p id="infoBarang" class="text-sm text-slate-500"></p>

            <form id="formKembali" method="POST" action="">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah Sisa yang Dikembalikan</label>
                        <input type="number" name="jumlah_kembali" id="jumlah_kembali" min="1" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94]">
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="flex-1 bg-[#3D6A82] hover:bg-[#2C5277] text-white py-2 rounded-lg text-sm font-medium">
                            Simpan & Tambah Stok
                        </button>
                        <button type="button" onclick="closeModal()"
                            class="flex-1 border border-slate-300 text-slate-700 py-2 rounded-lg text-sm font-medium hover:bg-slate-50">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function openModal(id, nama, max) {
                document.getElementById('formKembali').action = `/barang-keluar/${id}/kembalikan-sisa`;
                document.getElementById('infoBarang').innerText = `Barang: ${nama} (Maksimal sisa: ${max})`;
                document.getElementById('jumlah_kembali').max = max;
                document.getElementById('jumlah_kembali').value = 1;
                document.getElementById('modalKembali').classList.remove('hidden');
                document.getElementById('modalKembali').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('modalKembali').classList.add('hidden');
                document.getElementById('modalKembali').classList.remove('flex');
            }
        </script>
    @endpush

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
