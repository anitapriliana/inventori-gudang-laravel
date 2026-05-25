<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            // proyek_id: kolom penghubung ke tabel proyeks
            // nullable = boleh kosong (data lama gak punya proyek)
            // after('barang_id') = posisi kolom taruh setelah barang_id
            $table->foreignId('proyek_id')
                ->nullable()
                ->after('barang_id')
                ->constrained('proyeks') // terhubung ke tabel proyeks
                ->onDelete('set null'); // kalau proyek dihapus, ini jadi null (bukan ikut kehapus)
        });
    }

    public function down(): void
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->dropForeign(['proyek_id']);
            $table->dropColumn('proyek_id');
        });
    }
};
