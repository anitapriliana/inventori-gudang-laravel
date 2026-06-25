@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center space-x-4">
            <a href="{{ route('barang.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Barang Baru</h1>
            </div>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                <ul class="list-disc list-inside text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('barang.store') }}" method="POST" class="bg-white rounded-xl shadow-lg overflow-hidden">
            @csrf

            <div class="p-8 space-y-6">

                {{-- KATEGORI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori
                    </label>

                    <select name="kategori"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategoris as $k)
                            <option value="{{ $k->nama_kategori }}"
                                {{ old('kategori') == $k->nama_kategori ? 'selected' : '' }}>

                                {{ $k->nama_kategori }}

                            </option>
                        @endforeach

                    </select>

                    <div class="mt-3">
                        <input type="text" name="kategori_baru" placeholder="Atau tambah kategori baru"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>

                    @error('kategori')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NAMA --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('nama_barang') border-red-500 @enderror"
                        required>
                    @error('nama_barang')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- MERK --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Merk
                    </label>
                    <input type="text" name="merk" id="merk" value="{{ old('merk') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('merk') border-red-500 @enderror"
                        required>
                    @error('merk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- STOK --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Stok
                    </label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('stok') border-red-500 @enderror"
                        required>
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SATUAN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Satuan
                    </label>
                    <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('satuan') border-red-500 @enderror"
                        required>
                    @error('satuan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr>

                {{-- BUTTON --}}
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold shadow-lg transition">
                        Simpan
                    </button>

                    <a href="{{ route('barang.index') }}"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-center font-semibold shadow-lg">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                const nama = document.getElementById('nama_barang').value;
                const merk = document.getElementById('merk').value;
                const stok = document.getElementById('stok').value;

                if (!confirm(
                        `Yakin tambah barang?\n\nNama: ${nama}\nMerk: ${merk}\nStok: ${stok}`
                    )) {
                    e.preventDefault();
                }
            });
        </script>
    @endpush

@endsection
