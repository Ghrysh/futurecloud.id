<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Webmail</title>
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
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Reset Password</h2>
                    <p class="text-slate-500 text-sm mt-1">Perbarui password akun email VPS Anda</p>
                </div>

                @if (session('success'))
                    <div
                        class="mb-5 p-4 rounded-2xl bg-green-50 text-green-600 text-sm font-medium border border-green-100">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->has('error_global'))
                    <div class="mb-5 p-4 rounded-2xl bg-red-50 text-red-600 text-sm font-medium border border-red-100">
                        {{ $errors->first('error_global') }}
                    </div>
                @endif

                <form method="POST" action="{{ secure_url(route('webmail.password.update', [], false)) }}" class="space-y-5">
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
                        <label for="password"
                            class="text-xs font-bold uppercase tracking-wider text-slate-400 ml-1">Password Baru</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="w-full pr-12 px-4 py-3 bg-slate-100/50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 focus:bg-white transition-all text-slate-700 @error('password') ring-2 ring-red-400 @enderror"
                                placeholder="********">

                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <i id="eyeIcon" class="fa-regular fa-eye text-lg"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs font-medium mt-1 block ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="password_confirmation"
                            class="text-xs font-bold uppercase tracking-wider text-slate-400 ml-1">Konfirmasi
                            Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full pr-12 px-4 py-3 bg-slate-100/50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 focus:bg-white transition-all text-slate-700"
                                placeholder="********">

                            <button type="button" id="togglePasswordConfirm"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                                <i id="eyeIconConfirm" class="fa-regular fa-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full mt-4 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 transition-all transform active:scale-95">
                        Perbarui Password
                    </button>
                </form>

                {{-- Link Kembali ke Halaman Login --}}
                <div class="mt-6 text-center">
                    <a href="{{ secure_url(route('webmail.login')) }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors group">
                        <i class="fa-solid fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i>
                        Kembali ke Halaman Login
                    </a>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-xs text-slate-400">
                        Sistem Informasi Mail Client &copy; {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setupPasswordToggle(inputId, buttonId, iconId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = document.getElementById(iconId);

            button.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-regular', 'fa-eye');
                    icon.classList.add('fa-solid', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-solid', 'fa-eye-slash');
                    icon.classList.add('fa-regular', 'fa-eye');
                }
            });
        }

        setupPasswordToggle('password', 'togglePassword', 'eyeIcon');
        setupPasswordToggle('password_confirmation', 'togglePasswordConfirm', 'eyeIconConfirm');
    </script>
</body>

</html>
