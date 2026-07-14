<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        fetch('/sys-ping/v1?path=' + encodeURIComponent(window.location.pathname), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).catch(err => console.error('Tracking failed'));
    });
    </script>
    @include('components.chatbot')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.customAlert = function(message, type = 'info') {
            Swal.fire({
                title: type === 'error' ? 'Oops...' : (type === 'success' ? 'Berhasil' : 'Info'),
                text: message,
                icon: type,
                confirmButtonColor: '#2563eb'
            });
        };

        window.confirmSubmit = function(event, message) {
            event.preventDefault();
            const form = event.target.closest('form') || event.target;
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        };
        
        window.confirmClickLink = function(event, message) {
            event.preventDefault();
            const link = event.currentTarget.href;
            if(!link || link.includes('javascript:')) return;
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        };
    </script>

</body>
</html>
