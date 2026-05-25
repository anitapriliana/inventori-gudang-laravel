<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER BELUM LOGIN (GUEST)
|--------------------------------------------------------------------------
| Route di dalam middleware 'guest' hanya bisa diakses
| oleh user yang BELUM login
*/

Route::middleware('guest')->group(function () {

    // Menampilkan halaman login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Proses login (validasi username & password)
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER YANG SUDAH LOGIN (AUTH)
|--------------------------------------------------------------------------
| Route di dalam middleware 'auth' hanya bisa diakses
| oleh user yang SUDAH login
*/
Route::middleware('auth')->group(function () {

    // Logout user (menghapus session login)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
