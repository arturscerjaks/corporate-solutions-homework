<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'CS Homework')</title>

        {{-- Styles / Scripts --}}
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        @stack('head')
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white flex flex-col justify-between items-center p-6 lg:p-8 lg:justify-center min-h-screen">
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 grow starting:opacity-0">
            <main class="flex justify-center items-center w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                @yield('content')
            </main>
        </div>
    </body>
</html>
