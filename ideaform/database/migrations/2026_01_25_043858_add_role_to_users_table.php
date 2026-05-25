<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // kolom role, dibatasi cuma 3 nilai ini biar gak ada typo/nilai liar
            $table->enum('role', ['owner', 'kepala_gudang', 'admin_gudang'])
                ->default('admin_gudang'); // user lama otomatis jadi admin_gudang
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role'); // buat rollback migration ini
        });
    }
};
