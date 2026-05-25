@extends('layouts.app')

@section('title', 'Retur Barang')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- header --}}
        <div class="flex items-center space-x-4">
            <a href="{{ route('barang-keluar.index') }}"
                class="inline-flex items-center text-slate-500 hover:text-slate-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Retur Barang</h1>
            </div>
        </div>

        {{-- pesan error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg">
                <ul class="list-disc list-inside text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- form --}}
        <form action="{{ route('barang-keluar.return.store') }}" method="POST"
            class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            @csrf

            <div class="p-8 space-y-3">

                {{-- pilih barang --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Barang
                    </label>
                    <select name="barang_id" id="barang_id" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('barang_id') border-red-500 @enderror">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }} - {{ $b->merk }}
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- jumlah --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Jumlah
                    </label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('jumlah') border-red-500 @enderror"
                        required>
                    @error('jumlah')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Tanggal Retur
                    </label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- alasan --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Alasan Retur
                    </label>
                    <input type="text" name="alasan" id="alasan" value="{{ old('alasan') }}"
                        placeholder="Contoh: Barang rusak, salah kirim, dll."
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('alasan') border-red-500 @enderror"
                        required>
                    @error('alasan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-200">

                {{-- tombol --}}
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-[#3D6A82] hover:bg-[#2C5277] text-white py-2 rounded-lg font-medium transition-colors duration-150">
                        Simpan
                    </button>

                    <a href="{{ route('barang-keluar.index') }}"
                        class="flex-1 border border-slate-300 text-slate-700 py-2 rounded-lg text-center font-medium hover:bg-slate-50 transition-colors duration-150">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // konfirmasi sebelum submit
            document.querySelector('form').addEventListener('submit', function(e) {
                const barangSelect = document.getElementById('barang_id');
                const namaBarang = barangSelect.options[barangSelect.selectedIndex].text;

                const confirmed = confirm(
                    `Konfirmasi Retur Barang\n\n` +
                    `Barang: ${namaBarang}\n` +
                    `Jumlah: ${document.getElementById('jumlah').value}\n` +
                    `Tanggal: ${document.getElementById('tanggal').value}\n` +
                    `Alasan: ${document.getElementById('alasan').value}\n\n` +
                    `Lanjutkan?`
                );

                if (!confirmed) {
                    e.preventDefault();
                }
            });
        </script>
    @endpush

@endsection
