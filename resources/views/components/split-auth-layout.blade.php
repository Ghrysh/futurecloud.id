@props(['image'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 overflow-x-hidden">
    <div class="min-h-screen flex w-full">
        <!-- Left Side: Image -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-900">
            @if(isset($image))
                <img class="absolute inset-0 w-full h-full object-cover opacity-90" src="{{ asset($image) }}" alt="Auth Background">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 to-black/40"></div>
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-700"></div>
            @endif
            <div class="absolute inset-0 flex flex-col justify-end p-12 text-white">
                <h2 class="text-4xl font-bold mb-4 drop-shadow-md">FutureCloud</h2>
                <p class="text-lg text-gray-200 drop-shadow-sm max-w-md">Solusi cloud computing terbaik untuk masa depan bisnis Anda.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center py-12 px-6 sm:px-16 lg:px-24">
            <div class="w-full max-w-md mx-auto">
                <!-- Logo -->
                <div class="text-center sm:text-left mb-8 flex justify-center sm:justify-start">
                    <a href="/" class="inline-flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('favicon.svg') }}" alt="Logo" class="w-12 h-12">
                        <span class="text-2xl font-bold text-gray-800 tracking-tight">FutureCloud</span>
                    </a>
                </div>

                <!-- Form Container -->
                <div class="bg-white sm:shadow-xl sm:shadow-gray-200/50 sm:border sm:border-gray-100 rounded-2xl p-6 sm:p-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/sys-ping/v1?path=' + encodeURIComponent(window.location.pathname), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).catch(err => console.error('Tracking failed'));
        });
    </script>
    @include('components.chatbot')
</body>
</html>
