@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
    @php
        // expired terdekat dari stok masuk yang masih ada sisanya
        $expiredTerdekat = $barang->barangMasuk
            ->where('sisa_jumlah', '>', 0)
            ->whereNotNull('tanggal_kadaluwarsa')
            ->min('tanggal_kadaluwarsa');
    @endphp

    <div class="space-y-6">

        {{-- header halaman: tombol kembali di kiri --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <a href="{{ route('barang.index') }}"
                class="inline-flex items-center justify-center border border-slate-300 text-slate-700 font-medium py-2.5 px-5 rounded-lg transition-colors duration-150 hover:bg-slate-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>

            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Detail Barang</h1>
                <p class="text-slate-500 mt-1 text-sm">Rincian barang dan histori transaksi masuk &amp; keluar</p>
            </div>
        </div>

        {{-- kotak atas: rincian barang --}}
        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex flex-col sm:flex-row gap-6">

                {{-- gambar barang (placeholder kalau kosong) --}}
                <div class="flex justify-center sm:justify-start shrink-0">
                    @if ($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}"
                            class="w-40 h-40 object-cover rounded-lg border border-slate-200">
                    @else
                        <div
                            class="w-40 h-40 flex items-center justify-center bg-slate-50 rounded-lg border border-slate-200 text-slate-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h.01M4 4h16a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">{{ $barang->nama_barang }}</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-sm">
                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Kode Barang</span>
                            <span class="font-medium text-slate-800">{{ $barang->kode_barang ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Kategori</span>
                            <span class="font-medium text-slate-800">{{ $barang->kategori_display }}</span>
                        </div>
                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Merk</span>
                            <span class="font-medium text-slate-800">{{ $barang->merk ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Supplier</span>
                            <span class="font-medium text-slate-800">{{ $barang->supplier ?? '-' }}</span>
                        </div>

                        {{-- baris expired cuma muncul kalau ada --}}
                        @if ($expiredTerdekat)
                            <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                                <span class="text-slate-500">Expired Terdekat</span>
                                <span class="font-medium text-slate-800">
                                    {{ \Carbon\Carbon::parse($expiredTerdekat)->format('d/m/Y') }}
                                </span>
                            </div>
                        @endif

                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Stok</span>
                            <span class="font-medium text-slate-800 tabular-nums">{{ floatval($barang->stok) }}</span>
                        </div>
                        <div class="flex justify-between gap-4 border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Satuan</span>
                            <span class="font-medium text-slate-800">{{ $barang->satuan ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- kotak bawah: histori transaksi --}}
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div
                class="px-6 py-4 border-b border-slate-200 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Histori Transaksi</h2>
                    <p class="text-slate-500 text-sm mt-0.5">Diurutkan dari yang terbaru</p>
                </div>

                {{-- filter tanggal (GET biar kebawa di pagination) --}}
                <form method="GET" action="{{ route('barang.show', $barang->id) }}"
                    class="flex flex-col sm:flex-row sm:items-end gap-3">
                    <div>
                        <label for="tanggal" class="block text-xs font-medium text-slate-500 mb-1">Tanggal</label>
                        {{-- auto submit begitu tanggal dipilih --}}
                        <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}"
                            onchange="this.form.submit()"
                            class="border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-300">
                    </div>
                    <div class="flex gap-2">
                        @if (request()->filled('tanggal'))
                            <a href="{{ route('barang.show', $barang->id) }}"
                                class="border border-slate-300 text-slate-700 text-sm font-medium py-2 px-4 rounded-lg hover:bg-slate-50 transition-colors duration-150">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Jenis</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($historiTransaksi as $histori)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                {{-- nomor lanjut antar halaman --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500 tabular-nums">
                                    {{ $historiTransaksi->firstItem() + $loop->index }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                    {{ \Carbon\Carbon::parse($histori->tanggal)->format('d/m/Y') }}
                                </td>

                                {{-- badge jenis: hijau = masuk, merah = keluar --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($histori->jenis === 'Masuk')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                            Masuk
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                            Keluar
                                        </span>
                                    @endif
                                </td>

                                {{-- jumlah: + buat masuk, - buat keluar --}}
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-center text-sm font-semibold tabular-nums
                                    {{ $histori->jenis === 'Masuk' ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $histori->jenis === 'Masuk' ? '+' : '-' }}{{ floatval($histori->jumlah) }}
                                    <span class="text-xs font-normal text-slate-400">{{ $barang->satuan }}</span>
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $histori->keterangan }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-14 h-14 text-slate-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        {{-- pesan beda kalau lagi difilter --}}
                                        @if (request()->filled('tanggal'))
                                            <h3 class="text-base font-semibold text-slate-700 mb-1">Transaksi tidak
                                                ditemukan</h3>
                                            <p class="text-slate-500 text-sm">Tidak ada transaksi pada tanggal yang
                                                dipilih.</p>
                                        @else
                                            <h3 class="text-base font-semibold text-slate-700 mb-1">Belum ada transaksi
                                            </h3>
                                            <p class="text-slate-500 text-sm">Barang ini belum pernah masuk atau keluar.
                                            </p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- pagination (muncul kalau lebih dari 10 data) --}}
            @if ($historiTransaksi->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $historiTransaksi->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
