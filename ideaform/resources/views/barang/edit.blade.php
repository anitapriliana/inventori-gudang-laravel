@extends('layouts.app')

@section('title', 'Edit Barang')

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
                <h1 class="text-2xl font-semibold text-slate-900">Edit Barang</h1>
            </div>
        </div>

        {{-- pesan error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg" role="alert">
                <div class="flex">
                    <svg class="w-6 h-6 text-red-700 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
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
        {{-- PENTING: enctype="multipart/form-data" WAJIB ada supaya file gambar
             baru bisa terkirim. Tanpa ini, upload gambar gak akan pernah jalan. --}}
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg border border-slate-200 overflow-hidden">

            @csrf
            @method('PUT')

            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            <div class="p-8 space-y-5">

                {{-- nama barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Barang
                    </label>
                    <input type="text" name="nama_barang" id="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 @error('nama_barang') border-red-500 @enderror"
                        required autofocus>
                    @error('nama_barang')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- merk --}}
                <div>
                    <label for="merk" class="block text-sm font-medium text-slate-700 mb-2">
                        Merk
                    </label>
                    <input type="text" name="merk" id="merk" value="{{ old('merk', $barang->merk) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 @error('merk') border-red-500 @enderror"
                        required>
                    @error('merk')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- supplier (opsional) --}}
                <div>
                    <label for="supplier" class="block text-sm font-medium text-slate-700 mb-2">
                        Supplier <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="text" name="supplier" id="supplier" value="{{ old('supplier', $barang->supplier) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 @error('supplier') border-red-500 @enderror">
                    @error('supplier')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- gambar (baru, opsional) --}}
                <div>
                    <label for="gambar" class="block text-sm font-medium text-slate-700 mb-2">
                        Gambar Barang <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>

                    {{-- preview --}}
                    @if ($barang->gambar)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar saat ini"
                                class="w-32 h-32 object-cover rounded-lg border border-slate-200">
                            <p class="text-xs text-slate-400 mt-1">Gambar saat ini. Upload file baru untuk menggantinya.
                            </p>
                        </div>
                    @endif

                    <input type="file" name="gambar" id="gambar" accept="image/*"
                        class="w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-[#4C7A94] file:mr-4 file:py-2 file:px-3 file:border-0 file:bg-slate-100 file:text-slate-700 file:font-medium hover:file:bg-slate-200 @error('gambar') border-red-500 @enderror">
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, atau WEBP. Maks 2MB.</p>
                    @error('gambar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-200">

                {{-- button --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-150">
                        Update Barang
                    </button>

                    <a href="{{ route('barang.index') }}"
                        class="flex-1 inline-flex items-center justify-center border border-slate-300 text-slate-700 font-medium py-2.5 px-6 rounded-lg hover:bg-slate-50 transition-colors duration-150">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                const nama = document.getElementById('nama_barang')?.value || '';
                const merk = document.getElementById('merk')?.value || '';

                const confirmed = confirm(
                    `Yakin update?\n\nNama: ${nama}\nMerk: ${merk}`
                );

                if (!confirmed) e.preventDefault();
            });
        </script>
    @endpush

@endsection
