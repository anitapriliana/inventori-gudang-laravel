<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProyekController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    | Bebas role, semua user login boleh edit profilnya sendiri.
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | KELOLA BARANG
    |--------------------------------------------------------------------------
    | Semua role boleh lihat data barang, tapi cuma admin_gudang yang boleh
    | tambah/edit/hapus. Makanya resource-nya dipecah jadi 2 grup middleware.
    */

    // urutan penting: grup "manage" (ada /create) harus didaftar duluan,
    // sebelum grup "view" (ada /{barang} wildcard buat show) — biar
    // /barang/create gak ketangkep sama route show duluan
    Route::middleware('role:admin_gudang')->group(function () {
        Route::resource('barang', BarangController::class)->except(['index', 'show']);
    });

    Route::middleware('role:owner,kepala_gudang,admin_gudang')->group(function () {
        Route::resource('barang', BarangController::class)->only(['index', 'show']);
        Route::get('/kelola-barang', [BarangController::class, 'index'])->name('kelola-barang');
    });

    /*
    |--------------------------------------------------------------------------
    | AJAX AMBIL MERK
    |--------------------------------------------------------------------------
    | Dipake pas admin_gudang input barang keluar, jadi ikut role admin_gudang.
    */

    Route::middleware('role:admin_gudang')->group(function () {
        Route::get('/get-merk/{nama_barang}', [BarangKeluarController::class, 'getMerk'])
            ->name('get-merk');
    });

    /*
    |--------------------------------------------------------------------------
    | KATEGORI
    |--------------------------------------------------------------------------
    | Sama kaya Barang: semua bisa lihat, cuma admin_gudang yang bisa kelola.
    */

    Route::middleware('role:admin_gudang')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['index', 'show']);
    });

    Route::middleware('role:owner,kepala_gudang,admin_gudang')->group(function () {
        Route::resource('kategori', KategoriController::class)->only(['index', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | BARANG MASUK
    |--------------------------------------------------------------------------
    | Semua role boleh lihat, cuma admin_gudang yang boleh input/hapus.
    */

    Route::middleware('role:owner,kepala_gudang,admin_gudang')->group(function () {
        Route::get('/barang-masuk', [BarangMasukController::class, 'index'])
            ->name('barang-masuk.index');
    });

    Route::middleware('role:admin_gudang')->group(function () {
        Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])
            ->name('barang-masuk.create');

        Route::post('/barang-masuk', [BarangMasukController::class, 'store'])
            ->name('barang-masuk.store');

        Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])
            ->name('barang-masuk.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | BARANG KELUAR
    |--------------------------------------------------------------------------
    | Semua role boleh lihat, cuma admin_gudang yang boleh input/edit/retur/hapus.
    */

    Route::middleware('role:owner,kepala_gudang,admin_gudang')->group(function () {
        Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])
            ->name('barang-keluar.index');
    });

    Route::middleware('role:admin_gudang')->group(function () {
        Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])
            ->name('barang-keluar.create');

        // HARUS SEBELUM /{id}
        Route::get('/barang-keluar/return', [BarangKeluarController::class, 'returnCreate'])
            ->name('barang-keluar.return.create');

        Route::post('/barang-keluar/return', [BarangKeluarController::class, 'returnStore'])
            ->name('barang-keluar.return.store');

        Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])
            ->name('barang-keluar.store');

        Route::get('/barang-keluar/{id}/edit', [BarangKeluarController::class, 'edit'])
            ->name('barang-keluar.edit');

        Route::put('/barang-keluar/{id}', [BarangKeluarController::class, 'update'])
            ->name('barang-keluar.update');

        Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])
            ->name('barang-keluar.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    | Semua role boleh lihat & cetak laporan.
    */

    Route::middleware('role:owner,kepala_gudang,admin_gudang')->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan');

        Route::get('/laporan/masuk', [LaporanController::class, 'masuk'])
            ->name('laporan.masuk');

        Route::get('/laporan/keluar', [LaporanController::class, 'keluar'])
            ->name('laporan.keluar');

        Route::get('laporan/masuk/pdf', [LaporanController::class, 'masukPdf'])
            ->name('laporan.masuk.pdf');

        Route::get('laporan/keluar/pdf', [LaporanController::class, 'keluarPdf'])
            ->name('laporan.keluar.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | PROYEK
    |--------------------------------------------------------------------------
    | Kebalikan dari Barang: yang full CRUD di sini kepala_gudang,
    | admin_gudang & owner cuma boleh lihat.
    */

    Route::middleware('role:kepala_gudang')->group(function () {
        Route::resource('proyek', ProyekController::class)->except(['index', 'show']);
    });

    Route::middleware('role:owner,kepala_gudang,admin_gudang')->group(function () {
        Route::resource('proyek', ProyekController::class)->only(['index', 'show']);
    });
});

/*
|--------------------------------------------------------------------------
| AUTH LARAVEL BREEZE
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
