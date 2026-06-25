{{-- HALAMAN LOGIN --}}

@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    <div class="w-full max-w-sm">

        {{-- ===== HEADER ===== --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-black">Sistem Inventori Gudang</h1>
        </div>

        {{-- ===== FORM CARD ===== --}}
        <div class="rounded-2xl bg-white p-8 ring-1 ring-black/20 shadow-xl">

            {{-- Satu <form> saja — tidak ada nested form --}}
            <form method="POST" action="{{ route('login') }}" autocomplete="off" class="space-y-5">

                @csrf

                {{-- ===== FIELD EMAIL / USERNAME ===== --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-black">
                        Username
                    </label>
                    <div class="mt-1.5">
                        <input id="username" type="text" name="username" required autocomplete="username"
                            class="block w-full rounded-lg bg-white px-4 py-2.5 text-sm text-black
                                   placeholder:text-gray-500 ring-1 ring-white/10
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                                   transition duration-150
                                   {{ $errors->has('username') ? 'ring-red-500' : '' }}" />
                    </div>
                    @error('username')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ===== FIELD PASSWORD ===== --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-black">
                            Password
                        </label>
                        {{-- Ganti '#' dengan route lupa password jika sudah ada --}}
                        <a href="#" class="text-xs font-medium text-gray-700 hover:text-indigo-300 transition">
                            Lupa password?
                        </a>
                    </div>
                    <div class="mt-1.5">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-lg bg-white px-4 py-2.5 text-sm text-black
                                   placeholder:text-gray-500 ring-1 ring-white/10
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                                   transition duration-150
                                   {{ $errors->has('password') ? 'ring-red-500' : '' }}" />
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ===== TOMBOL SUBMIT ===== --}}
                <div class="pt-2">
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-indigo-600 px-4 py-2.5
                               text-sm font-semibold text-white
                               hover:bg-indigo-500
                               focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500
                               active:scale-[0.98] transition duration-150">Login
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
