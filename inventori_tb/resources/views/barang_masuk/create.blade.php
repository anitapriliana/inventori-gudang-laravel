{{-- HALAMAN INPUT BARANG MASUK --}}

@extends('layouts.app')

@section('title', 'Form Barang Masuk')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center space-x-4">

            <a href="{{ route('barang-masuk.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">

                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />

                </svg>

            </a>

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Tambah Barang Masuk
                </h1>
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

        {{-- Form --}}
        <form action="{{ route('barang-masuk.store') }}" method="POST"
            class="bg-white rounded-xl shadow-lg overflow-hidden">

            @csrf

            <div class="p-8 space-y-6">

                {{-- Tanggal --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Masuk
                    </label>

                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg" required>

                </div>

                {{-- Nama Barang --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Barang
                    </label>

                    <input type="text" id="nama_barang" list="list-barang" placeholder="Ketik nama barang..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg" oninput="setBarangId(this.value)"
                        required>

                    <datalist id="list-barang">

                        @foreach ($barang as $item)
                            <option value="{{ $item->nama_barang }}">
                            </option>
                        @endforeach

                    </datalist>

                </div>

                {{-- Merk --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Merk
                    </label>

                    <select id="merk" class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                        onchange="setBarangIdByMerk()" required>

                        <option value="">
                            -- Pilih Merk --
                        </option>

                    </select>

                    {{-- hidden barang_id --}}
                    <input type="hidden" name="barang_id" id="barang_id">

                </div>

                {{-- Jumlah --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah
                    </label>

                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg" required>

                </div>

                <hr class="border-gray-200">

                {{-- Button --}}
                <div class="flex flex-col sm:flex-row gap-4">

                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg">

                        Simpan

                    </button>

                    <a href="{{ route('barang-masuk.index') }}"
                        class="flex-1 inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg">

                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

    @push('scripts')
        <script>
            // Ambil merk berdasarkan nama barang
            function setBarangId(nama) {

                fetch(`/get-merk/${encodeURIComponent(nama)}`)

                    .then(response => response.json())

                    .then(data => {

                        const merkSelect =
                            document.getElementById('merk');

                        merkSelect.innerHTML =
                            '<option value="">-- Pilih Merk --</option>';

                        data.forEach(item => {

                            merkSelect.innerHTML += `
                                <option value="${item.id}">
                                    ${item.merk}
                                </option>
                            `;

                        });

                    });

            }

            // Set barang_id berdasarkan merk dipilih
            function setBarangIdByMerk() {

                const merkSelect =
                    document.getElementById('merk');

                document.getElementById('barang_id').value =
                    merkSelect.value;

            }

            // Confirm submit
            document.querySelector('form')
                .addEventListener('submit', function(e) {

                    const namaBarang =
                        document.getElementById('nama_barang').value;

                    const merk =
                        document.getElementById('merk');

                    const merkText =
                        merk.options[merk.selectedIndex].text;

                    const confirmed = confirm(

                        `Konfirmasi Barang Masuk\n\n` +

                        `Tanggal: ${document.getElementById('tanggal').value}\n` +

                        `Barang: ${namaBarang}\n` +

                        `Merk: ${merkText}\n` +

                        `Jumlah: ${document.getElementById('jumlah').value}\n\n` +

                        `Lanjutkan?`

                    );

                    if (!confirmed) {

                        e.preventDefault();

                    }

                });
        </script>
    @endpush

@endsection
