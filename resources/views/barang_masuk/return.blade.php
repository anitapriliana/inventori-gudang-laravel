{{-- Form Retur Barang ke Supplier --}}

@extends('layouts.app')

@section('title', 'Retur Barang ke Supplier')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Header halaman --}}
        <div class="flex items-center space-x-4">
            <a href="{{ route('barang-masuk.index') }}"
                class="inline-flex items-center text-slate-500 hover:text-slate-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Retur Barang ke Supplier</h1>
                <p class="text-slate-500 mt-1 text-sm">Kembalikan barang rusak/cacat ke supplier (stok gudang akan otomatis
                    berkurang).</p>
            </div>
        </div>

        {{-- Pesan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg" role="alert">
                <p class="font-semibold text-red-800 mb-1">Terjadi kesalahan input:</p>
                <ul class="list-disc list-inside text-red-700 space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Retur Barang --}}
        <form action="{{ route('barang-masuk.return.store') }}" method="POST"
            class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
            @csrf

            <div class="p-8 space-y-6">

                {{-- Pilih Barang --}}
                <div>
                    <label for="barang_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Pilih Barang
                    </label>
                    <select name="barang_id" id="barang_id" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('barang_id') border-red-500 @enderror">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }} {{ $b->merk ? '(' . $b->merk . ')' : '' }} - [Stok Gudang:
                                {{ $b->stok }} {{ $b->satuan ?? '' }}]
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah Retur --}}
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-slate-700 mb-2">
                        Jumlah Retur
                    </label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="0.01"
                        step="0.01"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('jumlah') border-red-500 @enderror"
                        required>
                    @error('jumlah')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Retur --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-2">
                        Tanggal Retur
                    </label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alasan Retur --}}
                <div>
                    <label for="alasan" class="block text-sm font-medium text-slate-700 mb-2">
                        Alasan Retur
                    </label>
                    <input type="text" name="alasan" id="alasan" value="{{ old('alasan') }}"
                        placeholder="Contoh: Barang cacat pabrik, kemasan rusak, salah kirim ukuran"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('alasan') border-red-500 @enderror"
                        required>
                    @error('alasan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-200">

                {{-- Tombol Aksi --}}
                <div class="flex gap-4 pt-2">
                    <button type="submit"
                        class="flex-1 bg-amber-700 hover:bg-amber-800 text-white py-2.5 rounded-lg font-medium transition-colors duration-150">
                        Simpan Retur
                    </button>

                    <a href="{{ route('barang-masuk.index') }}"
                        class="flex-1 border border-slate-300 text-slate-700 py-2.5 rounded-lg text-center font-medium hover:bg-slate-50 transition-colors duration-150">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Konfirmasi sebelum form submit
            document.querySelector('form').addEventListener('submit', function(e) {
                const barangSelect = document.getElementById('barang_id');
                const namaBarang = barangSelect.options[barangSelect.selectedIndex].text;
                const jumlah = document.getElementById('jumlah').value;
                const tanggal = document.getElementById('tanggal').value;
                const alasan = document.getElementById('alasan').value;

                if (!barangSelect.value) return;

                const confirmed = confirm(
                    `Konfirmasi Retur Barang ke Supplier\n\n` +
                    `Barang: ${namaBarang}\n` +
                    `Jumlah Retur: ${jumlah}\n` +
                    `Tanggal: ${tanggal}\n` +
                    `Alasan: ${alasan}\n\n` +
                    `Apakah Anda yakin data ini sudah benar? Stok gudang akan otomatis berkurang.`
                );

                if (!confirmed) {
                    e.preventDefault();
                }
            });
        </script>
    @endpush
@endsection
