<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Page Title --}}
    <title>{{ config('app.name', 'Inventori Gudang') }} - @yield('title', 'Login')</title>

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Full-screen dark background, konten ditengah --}}

<body class="min-h-screen bg-white flex items-center justify-center px-4">

    {{--
        @yield('content') — ini yang nge-render isi dari halaman child
        (login.blade.php, register.blade.php, dll)
        BUKAN $slot — $slot itu syntax Blade Component, bukan Blade Layout
    --}}
    @yield('content')

</body>

</html>
