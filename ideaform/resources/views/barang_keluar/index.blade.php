{{-- halaman index barang keluar --}}

@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
    <div class="space-y-6">

        {{-- header halaman --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Barang Keluar</h1>
                <p class="text-slate-500 mt-1 text-sm">Kelola transaksi barang keluar dan lihat riwayat data terbaru.</p>
            </div>

            {{-- tombol retur & tambah barang --}}
            @if (Auth::user()->role === 'admin_gudang')
                <div class="flex gap-3">
                    <a href="{{ route('barang-keluar.return.create') }}"
                        class="inline-flex items-center bg-amber-700 hover:bg-amber-800 text-white font-medium py-2.5 px-5 rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        Retur Barang
                    </a>

                    <a href="{{ route('barang-keluar.create') }}"
                        class="inline-flex items-center bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Barang Keluar
                    </a>
            @endif
        </div>
    </div>

    {{-- pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-50 border-l-2 border-green-600 p-4 rounded-lg animate-fade-in" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
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
        <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-700 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- tabel data --}}
    <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">

        {{-- header tabel --}}
        <div class="px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Riwayat Barang Keluar Terbaru</h2>
                <p class="text-slate-500 mt-1 text-sm">Menampilkan data transaksi barang keluar terbaru</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                {{--
                        Urutan kolom: No, Nama Barang, Merk, Jumlah, Tanggal, Status, Proyek, Aksi.
                        Kolom Proyek sengaja diletakkan setelah Status (sebelum Aksi).
                        Proyek diambil dari relasi $item->proyek->nama_proyek, bukan $item->proyek
                        langsung, karena $item->proyek adalah objek Eloquent (kalau dicetak
                        langsung hasilnya JSON mentah, bukan nama proyeknya).
                    --}}
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Nama Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Merk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Proyek</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition-colors duration-150">

                            {{-- nomor --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 tabular-nums">
                                {{ $index + 1 }}
                            </td>

                            {{-- nama barang --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-medium text-slate-800">
                                    {{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                                </p>
                            </td>

                            {{-- merk --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $item->barang->merk ?? '-' }}
                            </td>

                            {{-- jumlah --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 tabular-nums">
                                {{ $item->jumlah }} {{ $item->barang->satuan ?? '-' }}
                            </td>

                            {{-- tanggal --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 tabular-nums">
                                {{ date('d/m/Y', strtotime($item->tanggal)) }}
                            </td>

                            {{-- status — sebelumnya class "text-black-800" tidak valid di
                                     Tailwind jadi kedua badge tampil polos tanpa warna sama sekali --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($item->status === 'returned')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700">
                                        Retur
                                    </span>
                                @else
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">
                                        Keluar
                                    </span>
                                @endif
                            </td>

                            {{-- proyek --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $item->proyek->nama_proyek ?? '-' }}
                            </td>

                            {{-- aksi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <form action="{{ route('barang-keluar.destroy', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum ada data</h3>
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

    @push('scripts')
        <script>
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
