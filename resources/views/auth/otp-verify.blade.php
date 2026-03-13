<x-guest-layout>
    
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Background halaman */
        body {
            background-color: #f5f5f7;
        }
        
        /* Card container */
        .w-full.sm\:max-w-md.mt-6.px-6.py-4.bg-white.shadow-md.overflow-hidden.sm\:rounded-lg {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        
        /* Logo kotak biru dengan huruf 'F' */
        .fcloud-logo-box {
            background-color: #2563eb;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 700;
        }
        
        /* OTP Input Fields */
        .otp-input-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        
        .otp-input-group input[type="text"] {
            width: 48px;
            height: 56px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s;
            background-color: white;
            color: #111827;
        }
        
        .otp-input-group input[type="text"]:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .otp-separator {
            color: #d1d5db;
            font-size: 20px;
            font-weight: 500;
            margin: 0 4px;
        }
        
        /* Verify Account button */
        .btn-verify {
            background-color: #2563eb !important;
            color: white !important;
            border-radius: 8px !important;
            padding: 12px 24px !important;
            font-weight: 600 !important;
            font-size: 15px !important;
            transition: all 0.2s !important;
            border: none !important;
            cursor: pointer !important;
            width: 100%;
        }
        
        .btn-verify:hover {
            background-color: #1d4ed8 !important;
        }
        
        /* Resend button */
        .btn-resend {
            background: none;
            border: none;
            color: #2563eb;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            padding: 0;
            text-decoration: none;
        }
        
        .btn-resend:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
        
        /* Labels */
        label {
            font-weight: 500 !important;
            font-size: 14px !important;
            color: #374151 !important;
            margin-bottom: 8px !important;
            display: block;
        }
        
        /* Links */
        a {
            text-decoration: none;
        }
        
        /* Success/Error messages */
        .message-success {
            background-color: #ecfdf5;
            border: 1px solid #6ee7b7;
            color: #047857;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }
        
        .message-error {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }
    </style>

    <div class="p-8 sm:p-10 w-full max-w-sm mx-auto font-poppins">
        
        <!-- Logo dan Judul -->
        <div class="mb-8"> 
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5">
                <div class="fcloud-logo-box">
                    F
                </div>
                <span class="font-bold text-xl text-gray-900">FutureCloud.id</span>
            </a>
            <h1 class="text-2xl font-bold mt-8 text-gray-900">Verify Your Email</h1>
            <p class="text-sm text-gray-500 mt-1.5">
                A 6-digit code has been sent to your email address 
                <span class="font-semibold text-gray-800">({{ $email ?? 'your registered email' }})</span>
            </p>
        </div>
        
        <!-- Success/Error Messages -->
        @if (session('status'))
            <div class="message-success mb-4">
                {{ session('status') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="message-error mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        <!-- Form OTP -->
        <form method="POST" action="{{ route('otp.verify.submit') }}">
            @csrf

            <!-- OTP Input Fields -->
            <div class="mb-6">
                <x-input-label value="{{ __('Enter 6-digit code') }}" class="text-center" />
                
                <div id="otp-input-container" class="otp-input-group mt-3">
                    <input type="text" maxlength="1" data-index="0" required />
                    <input type="text" maxlength="1" data-index="1" required />
                    <input type="text" maxlength="1" data-index="2" required />
                    <span class="otp-separator">-</span>
                    <input type="text" maxlength="1" data-index="3" required />
                    <input type="text" maxlength="1" data-index="4" required />
                    <input type="text" maxlength="1" data-index="5" required />
                    
                    <!-- Hidden input untuk menggabungkan OTP -->
                    <input type="hidden" id="combined-otp" name="otp_code" />
                </div>
                
                <!-- Error messages -->
                <x-input-error :messages="$errors->get('otp_code')" class="mt-3 text-center" />
            </div>

            <!-- Verify Button -->
            <div class="mt-6">
                <button type="submit" class="btn-verify">
                    Verify Account
                </button>
            </div>
        </form>

        <!-- Resend Code -->
        <div class="text-center mt-6 text-sm text-gray-600">
            Didn't receive the code? 
            <form method="POST" action="{{ route('otp.resend') }}" class="inline-block">
                @csrf
                <button type="submit" class="btn-resend">
                    Resend Code
                </button>
            </form>
        </div>
        
        <!-- Back to Home -->
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-700">
                ← Back to home
            </a>
        </div>
    </div>

    <!-- JavaScript untuk OTP Input -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('otp-input-container');
            const inputs = container.querySelectorAll('input[type="text"]');
            const combinedOtpInput = document.getElementById('combined-otp');
            
            // Auto focus dan kombinasi kode OTP
            inputs.forEach((input, index) => {
                // Handle input event
                input.addEventListener('input', (e) => {
                    // Hanya terima angka
                    const value = e.target.value;
                    if (!/^\d*$/.test(value)) {
                        e.target.value = '';
                        return;
                    }
                    
                    // Pindah ke input berikutnya
                    if (e.target.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    
                    // Gabungkan semua nilai OTP
                    combineOtp();
                });

                // Handle keydown untuk backspace
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });

                // Handle paste event
                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text');
                    const digits = pastedData.replace(/\D/g, '').split('');
                    
                    digits.forEach((digit, i) => {
                        if (index + i < inputs.length) {
                            inputs[index + i].value = digit;
                        }
                    });
                    
                    // Focus ke input terakhir yang terisi
                    const lastFilledIndex = Math.min(index + digits.length - 1, inputs.length - 1);
                    inputs[lastFilledIndex].focus();
                    
                    combineOtp();
                });
            });

            // Fungsi untuk menggabungkan nilai OTP
            function combineOtp() {
                let otp = '';
                inputs.forEach(input => {
                    otp += input.value;
                });
                combinedOtpInput.value = otp;
            }
            
            // Auto focus ke input pertama saat halaman dimuat
            if (inputs.length > 0) {
                inputs[0].focus();
            }
        });
    </script>
</x-guest-layout>