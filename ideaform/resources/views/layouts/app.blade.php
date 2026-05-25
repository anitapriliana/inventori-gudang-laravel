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

<body class="flex h-screen bg-slate-50 overflow-hidden">

    {{-- SIDEBAR NAVIGATION — flat solid dark panel, accent bar marks the
         active route instead of a solid blue pill with a drop shadow --}}
    <aside class="bg-[#1C2530] w-64 flex flex-col">

        {{-- nama aplikasi --}}
        <div class="p-6 border-b border-white/10">
            <h1 class="text-lg font-semibold text-white tracking-tight">
                Inventori Gudang
            </h1>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 py-4 overflow-y-auto">

            {{-- dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 pl-4 pr-4 py-2.5 border-l-2 transition-colors duration-150
                {{ request()->routeIs('dashboard')
                    ? 'border-[#4C7A94] bg-white/5 text-white font-medium'
                    : 'border-transparent text-slate-400 hover:text-white hover:bg-white/5' }}">

                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>

                <span class="text-sm">Dashboard</span>
            </a>

            {{-- kelola barang dropdown --}}
            <div x-data="{
                open: {{ request()->routeIs('barang.*') || request()->routeIs('barang-masuk.*') || request()->routeIs('barang-keluar.*') ? 'true' : 'false' }}
            }">

                {{-- button --}}
                <button @click="open = !open"
                    class="flex items-center justify-between w-full pl-4 pr-4 py-2.5 border-l-2 transition-colors duration-150
                    {{ request()->routeIs('barang.*') ||
                    request()->routeIs('barang-masuk.*') ||
                    request()->routeIs('barang-keluar.*')
                        ? 'border-[#4C7A94] bg-white/5 text-white font-medium'
                        : 'border-transparent text-slate-400 hover:text-white hover:bg-white/5' }}">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>

                        <span class="text-sm">Kelola Barang</span>
                    </div>

                    {{-- Chevron --}}
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- dropdown menu --}}
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="ml-4 border-l border-white/10 pl-4 py-1 space-y-0.5">

                    {{-- data barang --}}
                    <a href="{{ route('barang.index') }}"
                        class="block px-3 py-2 rounded text-sm transition-colors duration-150
                        {{ request()->routeIs('barang.*') ? 'text-white font-medium' : 'text-slate-400 hover:text-white' }}">
                        Data Barang
                    </a>

                    {{-- barang masuk --}}
                    <a href="{{ route('barang-masuk.index') }}"
                        class="block px-3 py-2 rounded text-sm transition-colors duration-150
                        {{ request()->routeIs('barang-masuk.*') ? 'text-white font-medium' : 'text-slate-400 hover:text-white' }}">
                        Barang Masuk
                    </a>

                    {{-- barang keluar --}}
                    <a href="{{ route('barang-keluar.index') }}"
                        class="block px-3 py-2 rounded text-sm transition-colors duration-150
                        {{ request()->routeIs('barang-keluar.*') ? 'text-white font-medium' : 'text-slate-400 hover:text-white' }}">
                        Barang Keluar
                    </a>

                </div>
            </div>

            {{-- proyek --}}
            <a href="{{ route('proyek.index') }}"
                class="flex items-center gap-3 pl-4 pr-4 py-2.5 border-l-2 transition-colors duration-150
                {{ request()->routeIs('proyek.*')
                    ? 'border-[#4C7A94] bg-white/5 text-white font-medium'
                    : 'border-transparent text-slate-400 hover:text-white hover:bg-white/5' }}">

                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" />
                </svg>

                <span class="text-sm">Proyek</span>
            </a>

            {{-- laporan dropdown --}}
            <div x-data="{
                open: {{ request()->routeIs('laporan.*') ? 'true' : 'false' }}
            }">

                {{-- button --}}
                <button @click="open = !open"
                    class="flex items-center justify-between w-full pl-4 pr-4 py-2.5 border-l-2 transition-colors duration-150
                    {{ request()->routeIs('laporan.*')
                        ? 'border-[#4C7A94] bg-white/5 text-white font-medium'
                        : 'border-transparent text-slate-400 hover:text-white hover:bg-white/5' }}">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        <span class="text-sm">Laporan</span>
                    </div>

                    {{-- Chevron --}}
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- dropdown menu --}}
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="ml-4 border-l border-white/10 pl-4 py-1 space-y-0.5">

                    {{-- laporan barang masuk --}}
                    <a href="{{ route('laporan.masuk') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm transition-colors duration-150
                        {{ request()->routeIs('laporan.masuk') ? 'text-white font-medium' : 'text-slate-400 hover:text-white' }}">

                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Barang Masuk
                    </a>

                    {{-- laporan barang keluar --}}
                    <a href="{{ route('laporan.keluar') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm transition-colors duration-150
                        {{ request()->routeIs('laporan.keluar') ? 'text-white font-medium' : 'text-slate-400 hover:text-white' }}">

                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Barang Keluar
                    </a>
                </div>
            </div>
        </nav>

        {{-- logout --}}
        <div class="p-4 border-t border-white/10">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded text-sm text-slate-400
                    hover:bg-red-900/40 hover:text-red-200 transition-colors duration-150">

                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>

                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 overflow-y-auto bg-slate-50">
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
