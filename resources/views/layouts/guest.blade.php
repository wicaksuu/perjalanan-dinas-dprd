<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans text-slate-900 antialiased selection:bg-blue-500/10 selection:text-blue-600">
        <div class="min-h-screen relative bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-50 via-indigo-50 to-white overflow-hidden">
            <!-- Background Elements -->
            <div class="fixed inset-0 z-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#1e293b 1px, transparent 1px); background-size: 40px 40px;"></div>
            
            <div class="relative z-10">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts
    </body>
</html>
