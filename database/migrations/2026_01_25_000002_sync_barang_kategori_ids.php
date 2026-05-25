<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Dikosongkan karena kolom 'kategori' sudah dihapus di migrasi sebelumnya
        // dan database baru tidak membutuhkan sinkronisasi data lama.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
