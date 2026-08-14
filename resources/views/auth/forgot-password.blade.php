<x-split-auth-layout image="assets/reset_password.webp">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Lupa Kata Sandi?</h1>
        <p class="text-sm text-gray-600">
            Tidak masalah. Beritahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 transition">
                Kembali ke Login
            </a>
            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                Kirim Tautan Reset
            </x-primary-button>
        </div>
    </form>
</x-split-auth-layout>
