@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('kategori.index') }}"
                class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Kategori</h1>
                <p class="text-gray-600 mt-1">Perbarui data kategori barang</p>
            </div>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Kode Kategori --}}
                <div>
                    <label for="kode_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kode Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_kategori" id="kode_kategori"
                        value="{{ old('kode_kategori', $kategori->kode_kategori) }}" maxlength="20" required
                        class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 @error('kode_kategori') border-red-500 @enderror"
                        placeholder="Contoh: ELKT, PLMB, PRBT">
                    @error('kode_kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Kategori --}}
                <div>
                    <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_kategori" id="nama_kategori"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" maxlength="100" required
                        class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 @error('nama_kategori') border-red-500 @enderror"
                        placeholder="Contoh: ELEKTRONIK, PLUMBING, PERABOT">
                    @error('nama_kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="w-full px-4 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 resize-none"
                        placeholder="Deskripsi kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Opsional - Keterangan singkat tentang kategori</p>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('kategori.index') }}"
                        class="flex-1 inline-flex items-center justify-center bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-6 rounded-lg border border-gray-300 transition-all duration-200 shadow-sm hover:shadow">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </div>
@endsection
