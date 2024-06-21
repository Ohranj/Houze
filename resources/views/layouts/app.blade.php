<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-normal antialiased text-slate-800 m-0 p-0 min-h-screen flex flex-col">
    <x-unique.auth-nav />
    <main class="grow bg-gray-50 p-2 sm:px-0 sm:py-12">
        {{ $slot }}
    </main>
</body>

</html>