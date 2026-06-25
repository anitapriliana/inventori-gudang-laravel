<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    // Menampilkan halaman register
    public function create(): View
    {
        return view('auth.register');
    }

    // Proses data register dari form
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class], // tambah ini
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Simpan user baru ke database
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username, // tambah ini
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kirim event registered (untuk email verifikasi dll)
        event(new Registered($user));

        // Auto login setelah register berhasil
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
