@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- header --}}
        <div class="flex items-center space-x-4">
            <a href="{{ route('barang.index') }}"
                class="inline-flex items-center text-slate-500 hover:text-slate-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Tambah Barang Baru</h1>
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

        {{-- FORM --}}
        {{-- PENTING: enctype="multipart/form-data" WAJIB ditambahkan supaya file
             (gambar) benar-benar terkirim ke server. Tanpa ini, field gambar
             akan selalu kosong walaupun user sudah pilih file. --}}
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            @csrf

            <div class="p-8 space-y-3">

                {{-- nama --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('nama_barang') border-red-500 @enderror"
                        required>
                    @error('nama_barang')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- merk --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Merk
                    </label>
                    <input type="text" name="merk" id="merk" value="{{ old('merk') }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('merk') border-red-500 @enderror"
                        required>
                    @error('merk')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- supplier (opsional) --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Supplier <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="text" name="supplier" id="supplier" value="{{ old('supplier') }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('supplier') border-red-500 @enderror"
                        required>
                    @error('supplier')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- kategori --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kategori
                    </label>
                    <select name="kategori_id" id="kategori_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('kategori_id') border-red-500 @enderror"
                        required>
                        <option value=""> Pilih Kategori </option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- keterangan stok --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Stok
                    </label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('stok') border-red-500 @enderror"
                        required>
                    @error('stok')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- satuan --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Satuan
                    </label>
                    <input type="text" name="satuan" id="satuan" value="{{ old('satuan') }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('satuan') border-red-500 @enderror"
                        required>
                    @error('satuan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- gambar opsional --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Gambar Barang <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="file" name="gambar" id="gambar" accept="image/*"
                        class="w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-[#4C7A94] file:mr-4 file:py-2 file:px-3 file:border-0 file:bg-slate-100 file:text-slate-700 file:font-medium hover:file:bg-slate-200 @error('gambar') border-red-500 @enderror">
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, atau WEBP. Maks 2MB.</p>
                    @error('gambar')
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

                    {{-- batal: dulu tombol merah (kesannya destruktif), sekarang
                         ghost/outline karena ini cuma navigasi keluar form, bukan aksi hapus --}}
                    <a href="{{ route('barang.index') }}"
                        class="flex-1 border border-slate-300 text-slate-700 py-2 rounded-lg text-center font-medium hover:bg-slate-50 transition-colors duration-150">
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
