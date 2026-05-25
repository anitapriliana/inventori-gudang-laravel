{{-- halaman input barang masuk --}}

@extends('layouts.app')

@section('title', 'Form Barang Masuk')

@section('content')
    <div class="max-w-3xl mx-auto space-y-5">

        {{-- header --}}
        <div class="flex items-center space-x-3">
            <a href="{{ route('barang-masuk.index') }}"
                class="inline-flex items-center text-slate-500 hover:text-slate-900 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Tambah Barang Masuk</h1>
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

        {{-- form --}}
        <form action="{{ route('barang-masuk.store') }}" method="POST"
            class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            @csrf

            <!-- p-6 & space-y-4: Ukuran proporsional tengah-tengah -->
            <div class="p-6 space-y-4">

                {{-- tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Tanggal masuk
                    </label>
                    <input type="text" name="tanggal" id="tanggal" value="{{ old('tanggal', date('d/m/Y')) }}"
                        class="datepicker w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- nama barang --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Nama barang
                    </label>
                    <input type="text" id="nama_barang" list="list-barang" placeholder="Ketik nama barang..."
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94]"
                        oninput="setBarangId(this.value)" required>

                    <datalist id="list-barang">
                        @foreach ($barang as $item)
                            <option value="{{ $item->nama_barang }}" data-id="{{ $item->id }}"
                                data-kode="{{ $item->kode_barang }}"
                                data-kategori="{{ $item->getKategoriDisplayAttribute() }}">
                            </option>
                        @endforeach
                    </datalist>
                </div>

                {{-- expired --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Expired
                    </label>
                    <input type="month" name="tanggal_kadaluwarsa" id="tanggal_kadaluwarsa"
                        value="{{ old('tanggal_kadaluwarsa') }}"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('tanggal_kadaluwarsa') border-red-500 @enderror">
                    @error('tanggal_kadaluwarsa')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- merk --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Merk
                    </label>
                    <select id="merk"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94]"
                        onchange="setBarangIdByMerk()" required>
                        <option value=""> Pilih merk </option>
                    </select>

                    {{-- hidden barang_id --}}
                    <input type="hidden" name="barang_id" id="barang_id">
                </div>

                {{-- jumlah --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Jumlah
                    </label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                        class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] @error('jumlah') border-red-500 @enderror"
                        required>
                    @error('jumlah')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-slate-200 my-2">

                {{-- tombol --}}
                <div class="flex gap-4 pt-1">
                    <button type="submit"
                        class="flex-1 bg-[#3D6A82] hover:bg-[#2C5277] text-white py-2.5 rounded-lg font-medium transition-colors duration-150">
                        Simpan
                    </button>

                    <a href="{{ route('barang-masuk.index') }}"
                        class="flex-1 border border-slate-300 text-slate-700 py-2.5 rounded-lg text-center font-medium hover:bg-slate-50 transition-colors duration-150">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
        {{-- flatpickr css & js --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            // inisialisasi datepicker tanggal masuk
            flatpickr("#tanggal", {
                dateFormat: "d/m/Y",
                defaultDate: "{{ old('tanggal', date('d/m/Y')) }}"
            });

            // ambil merk berdasarkan nama barang dan siapkan opsi merk dengan metadata
            function setBarangId(nama) {
                fetch(`/get-merk/${encodeURIComponent(nama)}`)
                    .then(response => response.json())
                    .then(data => {
                        // abaikan response lama kalau input nama barang udah berubah lagi
                        if (nama !== document.getElementById('nama_barang').value) return;

                        const merkSelect = document.getElementById('merk');
                        merkSelect.innerHTML = '<option value="">-- Pilih Merk --</option>';
                        // buka kunci dulu, nanti dikunci lagi kalau merk cuma satu
                        merkSelect.disabled = false;
                        merkSelect.classList.remove('bg-slate-100', 'cursor-not-allowed');

                        data.forEach(item => {
                            merkSelect.innerHTML += `
                                <option value="${item.id}" data-kode="${item.kode_barang}" data-stok="${item.stok}" data-nama="${nama}" data-kategori="${item.kategori}" data-merk="${item.merk}">
                                    ${item.merk} ${item.kode_barang ? '(' + item.kode_barang + ')' : ''}
                                </option>
                            `;
                        });

                        // reset hidden barang_id sampai merk dipilih
                        document.getElementById('barang_id').value = '';

                        // kalau merk cuma satu: hapus opsi "Pilih Merk", kepilih otomatis, dropdown dikunci
                        if (data.length === 1) {
                            merkSelect.remove(0);
                            merkSelect.selectedIndex = 0;
                            merkSelect.disabled = true;
                            merkSelect.classList.add('bg-slate-100', 'cursor-not-allowed');
                            setBarangIdByMerk();
                        }
                    });
            }

            // set barang_id berdasarkan merk yang dipilih
            function setBarangIdByMerk() {
                const merkSelect = document.getElementById('merk');
                document.getElementById('barang_id').value = merkSelect.value;
            }

            // konfirmasi sebelum submit
            document.querySelector('form').addEventListener('submit', function(e) {
                const namaBarang = document.getElementById('nama_barang').value;
                const merk = document.getElementById('merk');
                const merkText = merk.options[merk.selectedIndex].text;

                const confirmed = confirm(
                    `Konfirmasi Barang Masuk\n\n` +
                    `Tanggal: ${document.getElementById('tanggal').value}\n` +
                    `Expired: ${document.getElementById('tanggal_kadaluwarsa').value || '-'}\n` +
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
