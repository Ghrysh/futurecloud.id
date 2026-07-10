<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Webmail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full border-t-4 border-blue-600">

    <div class="min-h-screen flex items-center justify-center p-6 bg-white relative overflow-hidden">
        <div class="absolute inset-0 z-0"
            style="background-image: 
                linear-gradient(to right, #f1f5f9 1px, transparent 1px), 
                linear-gradient(to bottom, #f1f5f9 1px, transparent 1px); 
                background-size: 40px 40px;">
        </div>

        <div class="relative z-10 w-full max-w-md">
            <div
                class="bg-white/80 backdrop-blur-lg rounded-[2rem] p-10 shadow-[0_20px_50px_rgba(148,163,184,0.15)] border border-white">

                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Log In Webmail</h2>
                    <p class="text-slate-500 text-sm mt-1">Gunakan akun email VPS Anda</p>
                </div>

                @if ($errors->any() && !$errors->has('email'))
                    <div class="mb-5 p-4 rounded-2xl bg-red-50 text-red-600 text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ secure_url(route('webmail.login.post', [], false)) }}" class="space-y-5">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="email"
                            class="text-xs font-bold uppercase tracking-wider text-slate-400 ml-1">Alamat Email</label>
                        <input id="email" type="email" name="email" required autofocus
                            class="w-full px-4 py-3 bg-slate-100/50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 focus:bg-white transition-all text-slate-700 @error('email') ring-2 ring-red-400 @enderror"
                            placeholder="example@futurecloud.id" value="{{ old('email') }}">

                        @error('email')
                            <span class="text-red-500 text-xs font-medium mt-1 block ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between px-1">
                            <label for="password"
                                class="text-xs font-bold uppercase tracking-wider text-slate-400">Password Email</label>

                            {{-- Tautan Lupa Password --}}
                            <a href="{{ secure_url(route('webmail.password.form', [], false)) }}"
                                class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline transition-colors">
                                Lupa Password?
                            </a>
                        </div>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="w-full pr-12 px-4 py-3 bg-slate-100/50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 focus:bg-white transition-all text-slate-700"
                                placeholder="********">

                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <i id="eyeIcon" class="fa-regular fa-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full {{ $errors->has('email') ? 'mt-2' : 'mt-4' }} py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 transition-all transform active:scale-95">
                        Masuk Ke Inbox
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-xs text-slate-400">
                        Sistem Informasi Mail Client &copy; {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePasswordButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ubah icon mata biasa (fa-eye) menjadi mata coret (fa-eye-slash)
                eyeIcon.classList.remove('fa-regular', 'fa-eye');
                eyeIcon.classList.add('fa-solid', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                // Kembalikan ke icon mata biasa
                eyeIcon.classList.remove('fa-solid', 'fa-eye-slash');
                eyeIcon.classList.add('fa-regular', 'fa-eye');
            }
        });
    </script>
</body>

</html>
