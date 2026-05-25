@extends('layouts.app')

@section('title', 'Stok Barang')

@section('content')
    <div class="space-y-6">

        {{-- header halaman --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Stok Barang</h1>
                <p class="text-slate-500 mt-1 text-sm">Kelola semua data stok barang di gudang</p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch gap-3">
                {{-- tombol kategori (aksi sekunder — ghost/outline, bukan gradient) --}}
                <a href="{{ route('kategori.index') }}"
                    class="inline-flex items-center justify-center border border-slate-300 text-slate-700 font-medium py-2.5 px-5 rounded-lg transition-colors duration-150 hover:bg-slate-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                    </svg>
                    Kategori
                </a>

                {{-- tombol tambah barang baru (aksi utama — flat, warna accent) --}}
                @if (Auth::user()->role === 'admin_gudang')
                    <a href="{{ route('barang.create') }}"
                        class="inline-flex items-center bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Barang Baru
                    </a>
                @endif
            </div>
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
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-red-800">Error!</p>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
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

        {{-- search bar dan filter kategori --}}
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            {{-- search bar --}}
            <form action="{{ route('barang.index') }}" method="GET" class="flex-1 sm:max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..."
                        onchange="this.form.submit()"
                        class="w-full pl-10 pr-4 py-2.5 text-sm text-slate-700 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150">
                </div>
            </form>

            <div class="flex items-center gap-3">
                {{-- filter kategori --}}
                <form method="GET" action="{{ route('barang.index') }}" class="sm:w-auto">
                    <div class="relative">
                        <select name="kategori" onchange="this.form.submit()"
                            class="appearance-none w-full sm:w-auto pl-4 pr-10 py-2.5 text-sm text-slate-700 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 cursor-pointer">
                            <option value="">Semua Kategori</option>

                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>

                                    {{ $k->nama_kategori }}

                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- tabel --}}
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">

                    {{-- header tabel --}}
                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kode Barang
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Nama Barang
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Stok
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Satuan
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    {{-- isi tabel --}}
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($barang as $index => $item)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">

                                {{-- nomor --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500 tabular-nums">
                                    {{ $barang->firstItem() + $loop->index }}
                                </td>

                                {{-- kode barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-700">
                                    {{ $item->kode_barang ?? '-' }}
                                </td>

                                {{-- nama barang --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-700">
                                    {{ $item->nama_barang }}
                                </td>

                                {{-- keterangan stok — dikasih warna sesuai status, sebelumnya semua abu-abu --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($item->stok == 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                            Habis
                                        </span>
                                    @elseif($item->stok <= 5)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 tabular-nums">
                                            {{ $item->stok }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 tabular-nums">
                                            {{ $item->stok }}
                                        </span>
                                    @endif
                                </td>

                                {{-- satuan --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500">
                                    {{ $item->satuan ?? '-' }}
                                </td>

                                {{-- aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- tombol detail (data-kadaluwarsa dikosongin kalau gak ada tanggal) --}}
                                        <button type="button" onclick="bukaDetailBarang(this)"
                                            data-kode="{{ $item->kode_barang ?? '-' }}"
                                            data-nama="{{ $item->nama_barang }}"
                                            data-kategori="{{ $item->kategori_display ?? '-' }}"
                                            data-merk="{{ $item->merk ?? '-' }}" data-stok="{{ $item->stok }}"
                                            data-supplier="{{ $item->supplier ?? '-' }}"
                                            data-satuan="{{ $item->satuan ?? '-' }}"
                                            data-kadaluwarsa="{{ $item->tanggal_kadaluwarsa_terdekat ? \Carbon\Carbon::parse($item->tanggal_kadaluwarsa_terdekat)->translatedFormat('F Y') : '' }}"
                                            data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                            class="inline-flex items-center justify-center w-9 h-9 text-slate-600 border border-slate-200 hover:bg-slate-100 rounded-lg transition-colors duration-150"
                                            title="Lihat detail barang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <a href="{{ route('barang.edit', ['barang' => $item->id, 'page' => request('page')]) }}"
                                            class="inline-flex items-center justify-center w-9 h-9 text-[#3D6A82] border border-[#4C7A94]/30 bg-[#4C7A94]/5 hover:bg-[#4C7A94] hover:text-white rounded-lg transition-colors duration-150"
                                            title="Edit barang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- form hapus barang --}}
                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Hapus barang {{ addslashes($item->nama_barang) }}?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 text-red-600 border border-red-200 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg transition-colors duration-150"
                                                title="Hapus barang">
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

                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m6 0v2m4-2v2" />
                                        </svg>
                                        <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum ada barang</h3>
                                        <p class="text-slate-500 text-sm">Tambahkan barang baru untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($barang->hasPages())
            <div
                class="flex flex-col sm:flex-row items-center justify-between gap-3 border border-slate-200 bg-white px-4 py-3 sm:px-6 rounded-lg">
                <div class="text-sm text-slate-600">
                    Menampilkan <span class="font-semibold text-slate-800 tabular-nums">{{ $barang->firstItem() }}</span>
                    -
                    <span class="font-semibold text-slate-800 tabular-nums">{{ $barang->lastItem() }}</span> dari
                    <span class="font-semibold text-slate-800 tabular-nums">{{ $barang->total() }}</span> barang
                </div>
                <div class="pagination-links">
                    {{ $barang->links() }}
                </div>
            </div>
        @endif
    </div>

    <div id="modalDetailBarang" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4">

        {{-- overlay gelap di belakang modal --}}
        <div class="absolute inset-0 bg-black/50" onclick="tutupDetailBarang()"></div>

        {{-- kotak konten modal --}}
        <div class="relative bg-white rounded-lg shadow-xl border border-slate-200 w-full max-w-md p-6 animate-fade-in">

            {{-- tombol close --}}
            <button type="button" onclick="tutupDetailBarang()"
                class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            {{-- gambar barang (kalau gak ada gambar, tampilin placeholder ikon) --}}
            <div class="mb-4 flex justify-center">
                <img id="detailGambar" src="" alt="Gambar barang"
                    class="hidden w-32 h-32 object-cover rounded-lg border border-slate-200">
                <div id="detailGambarKosong"
                    class="w-32 h-32 flex items-center justify-center bg-slate-50 rounded-lg border border-slate-200 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h.01M4 4h16a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Detail Barang</h2>

            {{-- setiap baris detail: label di kiri, value diisi JS lewat id-nya --}}
            <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Kode Barang</span>
                    <span id="detailKode" class="font-medium text-slate-800">-</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Nama Barang</span>
                    <span id="detailNama" class="font-medium text-slate-800">-</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Kategori</span>
                    <span id="detailKategori" class="font-medium text-slate-800">-</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Merk</span>
                    <span id="detailMerk" class="font-medium text-slate-800">-</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Supplier</span>
                    <span id="detailSupplier" class="font-medium text-slate-800">-</span>
                </div>
                {{-- baris expired: disembunyiin lewat JS kalau barang gak punya tanggal kadaluwarsa --}}
                <div id="rowKadaluwarsa" class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Expired</span>
                    <span id="detailKadaluwarsa" class="font-medium text-slate-800">-</span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Stok</span>
                    <span id="detailStok" class="font-medium text-slate-800 tabular-nums">-</span>
                </div>
                <div class="flex justify-between pb-2">
                    <span class="text-slate-500">Satuan</span>
                    <span id="detailSatuan" class="font-medium text-slate-800">-</span>
                </div>
            </div>
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
                // auto dismiss alerts
                document.querySelectorAll('[role="alert"]').forEach(alert => {
                    setTimeout(() => {
                        alert.style.transition = 'opacity 0.5s';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }, 5000);
                });
            });

            function bukaDetailBarang(btn) {
                document.getElementById('detailKode').textContent = btn.dataset.kode;
                document.getElementById('detailNama').textContent = btn.dataset.nama;
                document.getElementById('detailKategori').textContent = btn.dataset.kategori;
                document.getElementById('detailMerk').textContent = btn.dataset.merk;
                document.getElementById('detailSupplier').textContent = btn.dataset.supplier;
                document.getElementById('detailStok').textContent = btn.dataset.stok;
                document.getElementById('detailSatuan').textContent = btn.dataset.satuan;

                // baris expired cuma ditampilkan kalau ada tanggal kadaluwarsanya
                const rowKadaluwarsa = document.getElementById('rowKadaluwarsa');
                if (btn.dataset.kadaluwarsa) {
                    document.getElementById('detailKadaluwarsa').textContent = btn.dataset.kadaluwarsa;
                    rowKadaluwarsa.classList.remove('hidden');
                } else {
                    rowKadaluwarsa.classList.add('hidden');
                }

                // cek apakah barang ini punya gambar
                const gambarEl = document.getElementById('detailGambar');
                const kosongEl = document.getElementById('detailGambarKosong');

                if (btn.dataset.gambar) {
                    // ada gambar, tampilkan gambar dan sembunyikan placeholder
                    gambarEl.src = btn.dataset.gambar;
                    gambarEl.classList.remove('hidden');
                    kosongEl.classList.add('hidden');
                } else {
                    // tidak ada gambar, sembunyikan gambar dan tampilkan placeholder
                    gambarEl.src = '';
                    gambarEl.classList.add('hidden');
                    kosongEl.classList.remove('hidden');
                }

                // menampilkan modal dengan menghapus class "hidden"
                document.getElementById('modalDetailBarang').classList.remove('hidden');
            }

            function tutupDetailBarang() {
                document.getElementById('modalDetailBarang').classList.add('hidden');
            }

            // modal juga bisa ditutup dengan tombol esc di keyboard
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    tutupDetailBarang();
                }
            });
        </script>
    @endpush

@endsection
