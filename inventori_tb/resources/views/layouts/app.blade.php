<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Page Title --}}
    <title>{{ config('app.name', 'Inventori Gudang') }} - @yield('title', 'Dashboard')</title>

    {{-- Styles (Tailwind CSS via Vite) --}}
    @vite('resources/css/app.css')

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>

    {{-- Custom Styles --}}
    @stack('styles')
</head>

<body class="flex h-screen bg-gray-100 overflow-hidden">

    {{-- SIDEBAR NAVIGATION --}}
    <aside class="bg-gradient-to-b from-slate-800 to-slate-900 w-64 flex flex-col">

        {{-- Nama Aplikasi --}}
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold text-white">
                    Inventori Gudang
                </h1>
            </div>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 py-4 px-3 overflow-y-auto">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white shadow-lg'
                    : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">

                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>

                Dashboard
            </a>

            {{-- Kelola Barang --}}
            <a href="{{ route('barang.index') }}"
                class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
                {{ request()->routeIs('barang.*')
                    ? 'bg-blue-600 text-white shadow-lg'
                    : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">

                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>

                Kelola Barang
            </a>

            {{-- Barang Masuk --}}
            <a href="{{ route('barang-masuk.index') }}"
                class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
                {{ request()->routeIs('barang-masuk.*')
                    ? 'bg-blue-600 text-white shadow-lg'
                    : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-3">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                </svg>

                Barang Masuk
            </a>

            {{-- Barang Keluar --}}
            <a href="{{ route('barang-keluar.index') }}"
                class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
                {{ request()->routeIs('barang-keluar.*')
                    ? 'bg-blue-600 text-white shadow-lg'
                    : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 mr-3">

                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                </svg>

                Barang Keluar
            </a>

            {{-- Laporan Dropdown --}}
            <div x-data="{
                open: {{ request()->routeIs('laporan.*') ? 'true' : 'false' }}
            }" class="mb-2">

                {{-- Button --}}
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-4 py-3 rounded-lg transition-all duration-200 
                    {{ request()->routeIs('laporan.*')
                        ? 'bg-gray-700 text-white'
                        : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">

                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        <span class="font-medium">
                            Laporan
                        </span>
                    </div>

                    {{-- Chevron --}}
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mt-2 ml-4 space-y-1 border-l-2 border-gray-700 pl-4">

                    {{-- Laporan Barang Masuk --}}
                    <a href="{{ route('laporan.masuk') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200
                        {{ request()->routeIs('laporan.masuk')
                            ? 'bg-blue-600 text-white'
                            : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">

                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Barang Masuk
                    </a>

                    {{-- Laporan Barang Keluar --}}
                    <a href="{{ route('laporan.keluar') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200
                        {{ request()->routeIs('laporan.keluar')
                            ? 'bg-blue-600 text-white'
                            : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">

                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Barang Keluar
                    </a>
                </div>
            </div>
        </nav>

        {{-- Logout --}}
        <div class="p-4 border-t border-gray-700">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="flex items-center w-full px-4 py-3 rounded-lg text-gray-300 
                    hover:bg-red-600 hover:text-white transition-all duration-200">

                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>

                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 overflow-y-auto bg-gray-50">
        <div class="p-8">
            @yield('content')
        </div>
    </main>

    {{-- Scripts --}}
    @vite('resources/js/app.js')
    @stack('scripts')

    <script>
        // Auto hide alert
        document.addEventListener('DOMContentLoaded', function() {

            const alerts = document.querySelectorAll('[role="alert"]');

            alerts.forEach(alert => {

                setTimeout(() => {

                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';

                    setTimeout(() => {
                        alert.remove();
                    }, 500);

                }, 5000);

            });

        });
    </script>

</body>

</html>
