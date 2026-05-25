<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // menambah kolom tanggal_kadaluwarsa dan sisa_jumlah ke tabel barang_masuk
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->date('tanggal_kadaluwarsa')->nullable()->after('jumlah');
            $table->integer('sisa_jumlah')->default(0)->after('jumlah');
        });

        // isi sisa_jumlah awal agar sama dengan jumlah barang masuk
        DB::table('barang_masuk')->update([
            'sisa_jumlah' => DB::raw('jumlah'),
        ]);
    }

    public function down(): void
    {
        // hapus kolom jika migrasi di-rollback
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kadaluwarsa', 'sisa_jumlah']);
        });
    }
};
