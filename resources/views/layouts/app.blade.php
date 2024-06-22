<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
</head>

<body class="font-normal antialiased text-slate-800 m-0 p-0 flex flex-col">
    <div id="c_alerts" class="mx-auto flex absolute top-[80px] flex-col right-0 left-0 items-center"></div>
    <x-unique.auth-nav />
    <main class="bg-gray-50 p-2 sm:px-0 sm:py-12">
        {{ $slot }}
    </main>
</body>

</html>