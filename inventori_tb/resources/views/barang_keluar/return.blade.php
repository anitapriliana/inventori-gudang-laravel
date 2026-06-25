@extends('layouts.app')

@section('title', 'Retur Barang Keluar')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Retur Barang</h1>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('barang-keluar.return.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Pilih Barang --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                    <select name="barang_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }} - {{ $b->merk }}
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah</label>
                    <input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    @error('jumlah')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Retur</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    @error('tanggal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alasan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alasan Retur</label>
                    <input type="text" name="alasan" value="{{ old('alasan') }}" required
                        placeholder="Contoh: Barang rusak, salah kirim, dll."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    @error('alasan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                        Simpan
                    </button>
                    <a href="{{ route('barang-keluar.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
