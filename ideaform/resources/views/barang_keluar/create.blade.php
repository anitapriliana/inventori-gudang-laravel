{{-- input barang keluar --}}

@extends('layouts.app')

@section('title', 'Form Barang Keluar')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        {{-- header --}}
        <div class="flex items-center space-x-4">
            {{-- tombol panah kiri untuk kembali ke daftar barang keluar --}}
            <a href="{{ route('barang-keluar.index') }}"
                class="inline-flex items-center text-slate-500 hover:text-slate-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Tambah Barang Keluar</h1>
            </div>
        </div>

        {{-- pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-2 border-green-600 p-4 rounded-lg animate-fade-in" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-green-800">Berhasil!</p>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    {{-- tombol X untuk menutup alert secara manual --}}
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- pesan error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-2 border-red-700 p-4 rounded-lg" role="alert">
                <div class="flex">
                    <svg class="w-6 h-6 text-red-700 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-semibold text-red-800 mb-2">Terjadi kesalahan!</p>
                        {{-- loop semua pesan error dan tampilkan satu per satu --}}
                        <ul class="list-disc list-inside text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- form input --}}
        <form action="{{ route('barang-keluar.store') }}" method="POST"
            class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            @csrf

            <div class="p-8 space-y-5">

                {{-- tanggal --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-2">
                        Tanggal Keluar
                    </label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- nama barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Barang
                    </label>

                    <input type="text" id="nama_barang" list="list-barang" placeholder="Ketik nama barang..."
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150"
                        oninput="setBarangId(this.value)">

                    <datalist id="list-barang">
                        @foreach ($barang as $item)
                            <option value="{{ $item->nama_barang }}" data-id="{{ $item->id }}"
                                data-kode="{{ $item->kode_barang }}"
                                data-kategori="{{ $item->getKategoriDisplayAttribute() }}">
                            </option>
                        @endforeach
                    </datalist>

                    <input type="hidden" name="barang_id" id="barang_id">
                </div>

                {{-- merk --}}
                <div>
                    <label for="merk" class="block text-sm font-medium text-slate-700 mb-2">
                        Merk
                    </label>

                    <select id="merk"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150"
                        onchange="setBarangIdByMerk()" required>

                        <option value="">
                            -- Pilih Merk --
                        </option>
                    </select>
                </div>

                {{-- proyek (opsional) --}}
                <div>
                    <label for="proyek_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Proyek <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <select name="proyek_id" id="proyek_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150">
                        <option value="">-- Tidak terkait proyek --</option>
                        @foreach ($proyeks as $item)
                            <option value="{{ $item->id }}" {{ old('proyek_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- keterangan (opsional) --}}
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-slate-700 mb-2">
                        Keterangan <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 @error('keterangan') border-red-500 @enderror"
                        placeholder="Masukkan keterangan tambahan...">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-sm text-slate-500">
                        Keterangan ini akan tersimpan di catatan transaksi barang keluar.
                    </p>
                </div>

                {{-- jumlah --}}
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-slate-700 mb-2">
                        Jumlah
                    </label>
                    <div class="relative">
                        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                            step="1"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] transition-colors duration-150 @error('jumlah') border-red-500 @enderror"
                            placeholder="Masukkan jumlah barang" required oninput="validateJumlah()">
                    </div>
                    <div id="stok-info" class="hidden mt-2 text-sm text-slate-600">
                        Stok tersedia: <span id="stok-tersedia" class="font-semibold text-slate-800 tabular-nums">0</span>
                        unit
                    </div>
                    <div id="stok-warning" class="hidden mt-2 text-sm text-red-600 font-medium">
                        Jumlah melebihi stok tersedia.
                    </div>
                    @error('jumlah')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-200">

                {{-- tombol aksi --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    {{-- tombol submit — bisa dinonaktifkan oleh JS jika jumlah melebihi stok --}}
                    <button type="submit" id="btn-submit"
                        class="flex-1 inline-flex items-center justify-center bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Data
                    </button>

                    {{-- tombol batal — hanya link biasa, tidak submit form --}}
                    <a href="{{ route('barang-keluar.index') }}"
                        class="flex-1 inline-flex items-center justify-center border border-slate-300 text-slate-700 font-medium py-2.5 px-6 rounded-lg hover:bg-slate-50 transition-colors duration-150">
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
            /* animasi muncul dari atas untuk alert success */
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

            /* animasi getar untuk warning stok tidak cukup */
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

            /* ikon panah dropdown custom untuk elemen <select> */
            select {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%2394A3B8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
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

                        const merkSelect = document.getElementById('merk');

                        if (!merkSelect) return;

                        merkSelect.innerHTML = '<option value="">-- Pilih Merk --</option>';


                        data.forEach(item => {

                            merkSelect.innerHTML += `
                    <option value="${item.id}" data-kode="${item.kode_barang}" data-stok="${item.stok}" data-nama="${nama}" data-kategori="${item.kategori}" data-merk="${item.merk}">
                        ${item.merk} ${item.kode_barang ? '(' + item.kode_barang + ')' : ''}
                    </option>
                `;

                        });

                        // reset hidden barang_id until merk chosen
                        document.getElementById('barang_id').value = '';
                        updateStokInfo();

                    });

            }

            function setBarangIdByMerk() {

                const merkSelect = document.getElementById('merk');
                const barangId = document.getElementById('barang_id');

                if (!merkSelect || !barangId) return;

                barangId.value = merkSelect.value;
                updateStokInfo();

            }

            function updateStokInfo() {
                const merkSelect = document.getElementById('merk');
                const stokInfo = document.getElementById('stok-info');
                const stokTersedia = document.getElementById('stok-tersedia');
                const jumlahInput = document.getElementById('jumlah');

                if (!merkSelect || !stokInfo || !stokTersedia || !jumlahInput) return;

                const selectedOption = merkSelect.options[merkSelect.selectedIndex];

                if (merkSelect.value && selectedOption) {
                    const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
                    stokTersedia.textContent = stok;
                    stokInfo.classList.remove('hidden');
                    jumlahInput.max = stok;
                    validateJumlah();
                } else {
                    stokInfo.classList.add('hidden');
                    jumlahInput.removeAttribute('max');
                }
            }

            // dipanggil setiap kali nilai input jumlah berubah (oninput).
            // jika jumlah > stok: tampilkan warning + nonaktifkan tombol submit.
            // jika jumlah <= stok: sembunyikan warning + aktifkan kembali tombol submit.
            // juga memastikan nilai minimal tetap 1.
            function validateJumlah() {
                const merkSelect = document.getElementById('merk');
                const jumlahInput = document.getElementById('jumlah');
                const warning = document.getElementById('stok-warning');
                const btnSubmit = document.getElementById('btn-submit');

                if (!merkSelect || !jumlahInput || !warning || !btnSubmit) return; // belum pilih barang, skip validasi

                const selectedOption = merkSelect.options[merkSelect.selectedIndex];
                if (!selectedOption) return;

                const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
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

                if (jumlah < 1) jumlahInput.value = 1; // paksa minimal 1
            }

            // auto-focus ke field tanggal saat halaman pertama kali dimuat
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('tanggal')?.focus();

                const merkSelect = document.getElementById('merk');
                if (merkSelect) {
                    merkSelect.addEventListener('change', setBarangIdByMerk);
                }
            });

            // konfirmasi sebelum form dikirim ke server.
            // membaca data-nama dan data-merk dari option yang dipilih untuk ditampilkan di dialog.
            document.querySelector('form').addEventListener('submit', function(e) {

                const merkSelect = document.getElementById('merk');
                const selectedOption = merkSelect ? merkSelect.options[merkSelect.selectedIndex] : null;

                if (!selectedOption) {
                    alert('Silakan pilih barang terlebih dahulu.');
                    e.preventDefault();
                    return;
                }

                const confirmed = confirm(
                    `Konfirmasi Barang Keluar\n\n` +
                    `Tanggal: ${document.getElementById('tanggal').value}\n` +
                    `Barang: ${selectedOption.getAttribute('data-nama')} (${selectedOption.getAttribute('data-merk')})\n` +
                    `Jumlah: ${document.getElementById('jumlah').value} unit\n\n` +
                    `Stok akan otomatis berkurang!\n\n` +
                    `Lanjutkan?`
                );

                if (!confirmed) e.preventDefault(); // batalkan pengiriman jika user tekan Cancel
            });

            // auto-hide success alert setelah 5 detik dengan efek fade-out 0.5 detik
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
