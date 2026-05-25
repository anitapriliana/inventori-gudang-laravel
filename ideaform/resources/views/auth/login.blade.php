{{-- halaman login --}}

@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    <div class="w-full max-w-sm">

        {{-- header --}}
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-semibold text-slate-900">ideaform</h1>
        </div>

        {{-- form card (flat, border tipis, tanpa shadow) --}}
        <div class="rounded-lg bg-white p-8 border border-slate-200">

            <form method="POST" action="{{ route('login') }}" autocomplete="off" class="space-y-5">

                @csrf

                {{-- username --}}
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700">
                        Username
                    </label>
                    <div class="mt-1.5">
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required
                            autocomplete="username"
                            class="block w-full rounded-lg bg-white px-4 py-2.5 text-sm text-slate-700 border placeholder:text-slate-400 focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] focus:outline-none transition-colors duration-150 {{ $errors->has('username') ? 'border-red-600' : 'border-slate-300' }}" />
                    </div>
                    @error('username')
                        <p class="mt-1.5 text-xs text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-slate-700">
                            Password
                        </label>
                        {{-- ganti '#' dengan route lupa password jika sudah ada --}}
                        <a href="#"
                            class="text-xs font-medium text-[#3D6A82] hover:text-[#2C5277] transition-colors duration-150">
                            Lupa password?
                        </a>
                    </div>
                    <div class="mt-1.5">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-lg bg-white px-4 py-2.5 text-sm text-slate-700 border placeholder:text-slate-400 focus:ring-2 focus:ring-[#4C7A94] focus:border-[#4C7A94] focus:outline-none transition-colors duration-150 {{ $errors->has('password') ? 'border-red-600' : 'border-slate-300' }}" />
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                {{-- tombol submit (aksi utama — flat, warna accent) --}}
                <div class="pt-2">
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-[#3D6A82] hover:bg-[#2C5277] text-white font-medium py-2.5 px-4 text-sm transition-colors duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#4C7A94] focus-visible:ring-offset-2">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
