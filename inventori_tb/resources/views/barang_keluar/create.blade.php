{{-- HALAMAN INPUT BARANG KELUAR --}}

@extends('layouts.app')

@section('title', 'Form Barang Keluar')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Page header --}}
        <div class="flex items-center space-x-4">
            {{-- Tombol panah kiri untuk kembali ke daftar barang keluar --}}
            <a href="{{ route('barang-keluar.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Barang Keluar</h1>
            </div>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-green-800">Berhasil!</p>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    {{-- Tombol X untuk menutup alert secara manual --}}
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" role="alert">
                <div class="flex">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-semibold text-red-800 mb-2">Terjadi kesalahan!</p>
                        {{-- Loop semua pesan error dan tampilkan satu per satu --}}
                        <ul class="list-disc list-inside text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form input --}}
        <form action="{{ route('barang-keluar.store') }}" method="POST"
            class="bg-white rounded-xl shadow-lg overflow-hidden">
            @csrf

            <div class="p-8 space-y-6">

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Keluar
                    </label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-150 @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Barang
                    </label>

                    <input type="text" id="nama_barang" list="list-barang" placeholder="Ketik nama barang..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg" oninput="setBarangId(this.value)">

                    <datalist id="list-barang">
                        @foreach ($barang as $item)
                            <option value="{{ $item->nama_barang }}" data-id="{{ $item->id }}">
                            </option>
                        @endforeach
                    </datalist>

                    <input type="hidden" name="barang_id" id="barang_id">
                </div>

                {{-- Merk --}}
                <div>
                    <label for="merk" class="block text-sm font-semibold text-gray-700 mb-2">
                        Merk
                    </label>

                    <select id="merk" class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                        onchange="setBarangIdByMerk()" required>

                        <option value="">
                            -- Pilih Merk --
                        </option>

                    </select>

                </div>

                {{-- Jumlah --}}
                <div>
                    <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah
                    </label>
                    <div class="relative">
                        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                            step="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-150 @error('jumlah') border-red-500 @enderror"
                            placeholder="Masukkan jumlah barang" required oninput="validateJumlah()">
                    </div>
                    @error('jumlah')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-200">

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    {{-- Tombol submit — bisa dinonaktifkan oleh JS jika jumlah melebihi stok --}}
                    <button type="submit" id="btn-submit"
                        class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Data
                    </button>

                    {{-- Tombol batal — hanya link biasa, tidak submit form --}}
                    <a href="{{ route('barang-keluar.index') }}"
                        class="flex-1 inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>

    @push('styles')
        <style>
            /* Animasi muncul dari atas untuk alert success */
            @keyframes fade-in {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fade-in 0.3s ease-out;
            }

            /* Animasi getar untuk warning stok tidak cukup */
            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                25% {
                    transform: translateX(-5px);
                }

                75% {
                    transform: translateX(5px);
                }
            }

            .animate-shake {
                animation: shake 0.3s ease-in-out;
            }

            /* Ikon panah dropdown custom untuk elemen <select> */
            select {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
                background-position: right 0.5rem center;
                background-repeat: no-repeat;
                background-size: 1.5em 1.5em;
                padding-right: 2.5rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
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

            function setBarangIdByMerk() {

                const merkSelect =
                    document.getElementById('merk');

                document.getElementById('barang_id').value =
                    merkSelect.value;

            }

            function updateStokInfo() {
                const select = document.getElementById('barang_id');
                const selectedOption = select.options[select.selectedIndex];
                const stokInfo = document.getElementById('stok-info');
                const stokTersedia = document.getElementById('stok-tersedia');

                if (select.value) {
                    const stok = selectedOption.getAttribute('data-stok');
                    stokTersedia.textContent = stok;
                    stokInfo.classList.remove('hidden');
                    document.getElementById('jumlah').max = stok; // Batasi max input secara dinamis
                    validateJumlah();
                } else {
                    stokInfo.classList.add('hidden'); // Sembunyikan jika belum ada barang dipilih
                }
            }

            // Dipanggil setiap kali nilai input jumlah berubah (oninput).
            // Jika jumlah > stok: tampilkan warning + nonaktifkan tombol submit.
            // Jika jumlah <= stok: sembunyikan warning + aktifkan kembali tombol submit.
            // Juga memastikan nilai minimal tetap 1.
            function validateJumlah() {
                const select = document.getElementById('barang_id');
                const jumlahInput = document.getElementById('jumlah');
                const warning = document.getElementById('stok-warning');
                const btnSubmit = document.getElementById('btn-submit');

                if (!select.value) return; // Belum pilih barang, skip validasi

                const stok = parseInt(select.options[select.selectedIndex].getAttribute('data-stok'));
                const jumlah = parseInt(jumlahInput.value);

                if (jumlah > stok) {
                    warning.classList.remove('hidden');
                    btnSubmit.disabled = true;
                    btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
                    btnSubmit.title = 'Jumlah melebihi stok tersedia';
                } else {
                    warning.classList.add('hidden');
                    btnSubmit.disabled = false;
                    btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
                    btnSubmit.title = '';
                }

                if (jumlah < 1) jumlahInput.value = 1; // Paksa minimal 1
            }

            // Auto-focus ke field tanggal saat halaman pertama kali dimuat
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('tanggal').focus();
            });

            // Konfirmasi sebelum form dikirim ke server.
            // Membaca data-nama dan data-merk dari option yang dipilih untuk ditampilkan di dialog.
            document.querySelector('form').addEventListener('submit', function(e) {
                const select = document.getElementById('barang_id');
                const selectedOption = select.options[select.selectedIndex];

                const confirmed = confirm(
                    `Konfirmasi Barang Keluar\n\n` +
                    `Tanggal: ${document.getElementById('tanggal').value}\n` +
                    `Barang: ${selectedOption.getAttribute('data-nama')} (${selectedOption.getAttribute('data-merk')})\n` +
                    `Jumlah: ${document.getElementById('jumlah').value} unit\n\n` +
                    `Stok akan otomatis berkurang!\n\n` +
                    `Lanjutkan?`
                );

                if (!confirmed) e.preventDefault(); // Batalkan pengiriman jika user tekan Cancel
            });

            // Auto-hide success alert setelah 5 detik dengan efek fade-out 0.5 detik
            setTimeout(() => {
                const alert = document.querySelector('[role="alert"]');
                if (alert && alert.classList.contains('bg-green-50')) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        </script>
    @endpush
@endsection
