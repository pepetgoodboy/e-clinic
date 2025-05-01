<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center px-2 sm:px-0 bg-gray-100">
        <div class="flex flex-col gap-4 justify-center items-center">
            <h2 class="text-3xl font-bold text-blue-500">E-Clinic</h2>
            <a href="/">
                <x-application-logo class="w-20 h-20" />
            </a>
        </div>
        <p class="mt-8 text-gray-800 text-center font-semibold text-sm w-11/12 sm:w-full">Silahkan login untuk melanjutkan proses pelayanan di E-Clinic.</p>

        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden rounded-lg border-t-4 border-blue-500">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
