@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Halaman header --}}
        <div class="flex items-center space-x-4">

            <a href="{{ route('barang.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Barang</h1>
            </div>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" role="alert">
                <div class="flex">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16z" />
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

        {{-- FORM --}}
        <form action="{{ route('barang.update', $barang->id) }}" method="POST"
            class="bg-white rounded-xl shadow-lg overflow-hidden">

            @csrf
            @method('PUT')

            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            <div class="p-8 space-y-6">

                {{-- KATEGORI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori
                    </label>
                    <select name="kategori" class="w-full px-4 py-3 border border-gray-300 rounded-lg" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="SMEN" {{ $barang->kategori == 'SMEN' ? 'selected' : '' }}>Semen</option>
                        <option value="CAT" {{ $barang->kategori == 'CAT' ? 'selected' : '' }}>Cat</option>
                        <option value="ATK" {{ $barang->kategori == 'ATK' ? 'selected' : '' }}>ATK</option>
                    </select>
                </div>

                {{-- NAMA BARANG --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-150 @error('nama_barang') border-red-500 @enderror"
                        required autofocus>
                    @error('nama_barang')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-200">

                {{-- BUTTON --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg">
                        Update Barang
                    </button>

                    <a href="{{ route('barang.index') }}"
                        class="flex-1 inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg">
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

                const confirmed = confirm(
                    `Yakin update?\n\nNama: ${nama}\nMerk: ${merk}\nStok: ${stok}`
                );

                if (!confirmed) e.preventDefault();
            });
        </script>
    @endpush

@endsection
