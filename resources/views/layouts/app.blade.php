<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.png" />
        <title>{{ config('app.name', 'BizBot') }}</title>
        <!-- Scripts -->
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />--}}
{{--        <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    @vite(['resources/js/app.js'])--}}
<!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>

    <body class="font-sans antialiased h-full" >
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
