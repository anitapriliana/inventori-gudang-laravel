{{-- halaman edit proyek --}}

@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- header --}}
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Edit Proyek</h1>
            <p class="text-slate-500 mt-1">Ubah data proyek "{{ $proyek->nama_proyek }}".</p>
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
        <form action="{{ route('proyek.update', $proyek->id) }}" method="POST"
            class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-8 space-y-3">

                {{-- nama proyek (wajib) --}}
                <div>
                    <label for="nama_proyek" class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Proyek
                    </label>
                    {{-- old() dipakai kalau ada error validasi, kalau gak ada pakai data proyek --}}
                    <input type="text" name="nama_proyek" id="nama_proyek"
                        value="{{ old('nama_proyek', $proyek->nama_proyek) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('nama_proyek') border-red-500 @enderror"
                        required>
                    @error('nama_proyek')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- lokasi (opsional) --}}
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-slate-700 mb-2">
                        Lokasi <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $proyek->lokasi) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('lokasi') border-red-500 @enderror">
                    @error('lokasi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-200">

                {{-- tombol --}}
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-[#3D6A82] hover:bg-[#2C5277] text-white py-2 rounded-lg font-medium transition-colors duration-150">
                        Update
                    </button>

                    <a href="{{ route('proyek.index') }}"
                        class="flex-1 border border-slate-300 text-slate-700 py-2 rounded-lg text-center font-medium hover:bg-slate-50 transition-colors duration-150">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>
@endsection
