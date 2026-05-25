<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom supplier sudah ada di create_barangs_table, jadi tidak perlu ditambah lagi
    }

    public function down(): void
    {
        // Tidak ada yang perlu di-rollback karena kolom sudah ada di tabel awal
    }
};
