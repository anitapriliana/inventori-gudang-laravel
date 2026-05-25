<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek'); // wajib diisi
            $table->string('lokasi')->nullable(); // opsional
            $table->date('tanggal_mulai')->nullable(); // opsional
            $table->text('keterangan')->nullable(); // opsional
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
