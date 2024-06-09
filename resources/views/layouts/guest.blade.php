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

<body class="font-normal antialiased text-slate-800 m-0 p-0 h-screen">
    <div id="c_alerts" class="mx-auto flex absolute top-[80px] flex-col right-0 left-0 items-center"></div>

    {{ $main }}

    <div class="flex gap-1 items-center absolute bottom-2 left-2">
        <a href="https://github.com/ohranj" target="_blank">
            <x-svg.github class="w-6 h-6 cursor-pointer hover:scale-[1.2]" fill="currentColor" />
        </a>
        <a href="/">
            <x-svg.reddit class="w-6 h-6 cursor-pointer hover:scale-[1.2]" fill="currentColor" />
        </a>
    </div>
</body>

</html>