<x-split-auth-layout image="assets/login.png">
    {{-- Load Remix Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .fcloud-logo-box {
            display: none;
        }

        /* Input fields styling container */
        .input-with-icon {
            position: relative;
        }

        .input-icon-left {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 20px;
            pointer-events: none;
            z-index: 10;
        }

        .input-icon-right {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 10;
        }

        .input-icon-right:hover {
            color: #4b5563;
        }

        /* Override input styling agar konsisten */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            border: 1.5px solid #e5e7eb !important;
            border-radius: 10px !important;
            padding: 12px 12px 12px 48px !important;
            /* Padding kiri besar untuk icon */
            font-size: 14px !important;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        /* Khusus input tanpa icon (First Name & Last Name) */
        input.no-icon {
            padding-left: 16px !important;
        }

        input:focus {
            background-color: #fff;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
            outline: none !important;
        }

        /* Placeholder styling */
        input::placeholder {
            color: #9ca3af;
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            cursor: pointer;
        }

        input[type="checkbox"]:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        /* Create Account button */
        .btn-create-account {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2563eb !important;
            color: white !important;
            border-radius: 10px !important;
            padding: 14px 24px !important;
            font-weight: 600 !important;
            font-size: 15px !important;
            transition: all 0.2s !important;
            border: none !important;
            cursor: pointer !important;
            width: 100%;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.4);
        }

        .btn-create-account:hover {
            background-color: #1d4ed8 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 8px -1px rgba(37, 99, 235, 0.5);
        }

        .btn-create-account:active {
            transform: translateY(0);
        }

        /* Social login buttons */
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background-color: white;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
        }

        .social-btn:hover {
            background-color: #f9fafb;
            border-color: #d1d5db;
        }

        .social-btn i {
            font-size: 20px;
            color: #ea4335;
            /* Google Red */
        }

        /* Labels */
        label {
            font-weight: 600 !important;
            font-size: 13px !important;
            color: #374151 !important;
            margin-bottom: 6px !important;
            display: block;
        }

        /* Links */
        a {
            text-decoration: none;
        }

        /* Divider text */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .divider:not(:empty)::before {
            margin-right: .75em;
        }

        .divider:not(:empty)::after {
            margin-left: .75em;
        }

        /* Terms label specific */
        .terms-label {
            font-size: 13px !important;
            font-weight: 400 !important;
            color: #4b5563 !important;
            line-height: 1.5;
        }
    </style>

    <div class="font-poppins">

        <div>
            <!-- Judul -->
            <div class="mb-8 sm:text-left">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun</h1>
                <p class="text-base text-gray-500">Masukkan informasi Anda untuk memulai.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Username -->
                <div class="mb-4">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="ri-hashtag input-icon-left"></i>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required
                            autofocus placeholder="user123" />
                    </div>
                    <x-input-error :messages="$errors->get('username')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Grid: First Name & Last Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <!-- First Name -->
                    <div>
                        <label for="first_name">Nama Depan</label>
                        <input id="first_name" class="no-icon" type="text" name="first_name"
                            value="{{ old('first_name') }}" required placeholder="Budi" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-xs text-red-500" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name">Nama Belakang</label>
                        <input id="last_name" class="no-icon" type="text" name="last_name"
                            value="{{ old('last_name') }}" required placeholder="Santoso" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-xs text-red-500" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email">Alamat Email</label>
                    <div class="input-with-icon">
                        <i class="ri-mail-line input-icon-left"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="nama@contoh.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password">Kata Sandi</label>
                    <div class="input-with-icon">
                        <i class="ri-lock-2-line input-icon-left"></i>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Buat kata sandi yang kuat" />
                        <i id="togglePassword" class="ri-eye-off-line input-icon-right"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-with-icon">
                        <i class="ri-lock-2-line input-icon-left"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Ulangi kata sandi" />
                        <i id="toggleConfirmPassword" class="ri-eye-off-line input-icon-right"></i>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="mb-6">
                    <label for="terms_agreed" class="inline-flex items-start gap-3 cursor-pointer group">
                        <input id="terms_agreed" type="checkbox" name="terms_agreed" required class="mt-1">
                        <span class="terms-label text-gray-600 group-hover:text-gray-800 transition">
                            Saya setuju dengan <a href="#"
                                class="text-blue-600 hover:text-blue-700 font-semibold hover:underline">Syarat
                                Layanan</a> dan <a href="#"
                                class="text-blue-600 hover:text-blue-700 font-semibold hover:underline">Kebijakan
                                Privasi</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-create-account">
                    Buat Akun
                </button>
            </form>

            <!-- Social Login Divider -->
            <div class="divider">ATAU DAFTAR DENGAN</div>

            <!-- Social Buttons -->
            <div>
                <a href="{{ route('social.redirect', 'google') }}" class="social-btn w-full">
                    <svg class="h-5 w-5" viewBox="0 0 24 24">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    <span>Daftar dengan Google</span>
                </a>
            </div>

            <!-- Sign in link -->
            <div class="text-center mt-8 text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:text-blue-700 hover:underline">
                    Masuk
                </a>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-4">
                <a href="{{ url('/') }}"
                    class="text-xs text-gray-400 hover:text-gray-600 transition flex items-center justify-center gap-1">
                    <i class="ri-arrow-left-line"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Toggle Password -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi helper untuk toggle password
            function setupPasswordToggle(toggleId, passwordId) {
                const toggle = document.getElementById(toggleId);
                const password = document.getElementById(passwordId);

                if (toggle && password) {
                    toggle.addEventListener('click', function() {
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);

                        if (type === 'password') {
                            this.classList.remove('ri-eye-line');
                            this.classList.add('ri-eye-off-line');
                        } else {
                            this.classList.remove('ri-eye-off-line');
                            this.classList.add('ri-eye-line');
                        }
                    });
                }
            }

            // Inisialisasi untuk kedua field password
            setupPasswordToggle('togglePassword', 'password');
            setupPasswordToggle('toggleConfirmPassword', 'password_confirmation');
        });
    </script>
</x-split-auth-layout>
