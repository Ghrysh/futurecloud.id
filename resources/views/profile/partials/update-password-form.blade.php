<section>
    @if(Auth::user()->password !== null)
        {{-- Formulir Ganti Password Standar --}}
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <label for="update_password_current_password">Kata Sandi Saat Ini</label>
                <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required autocomplete="current-password" />
                @error('current_password', 'updatePassword')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="update_password_password">Kata Sandi Baru</label>
                <input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required autocomplete="new-password" />
                @error('password', 'updatePassword')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="update_password_password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required autocomplete="new-password" />
                @error('password_confirmation', 'updatePassword')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Simpan Kata Sandi
                </button>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-green-600 font-medium">Berhasil diperbarui.</p>
                @endif
            </div>
        </form>
    @else
        {{-- Alur Set Password untuk Akun Google tanpa Password --}}
        <div x-data="setPasswordFlow()" class="space-y-6">
            
            {{-- Step 1: Init (Tombol Atur Kata Sandi) --}}
            <div x-show="step === 1" class="text-center md:text-left">
                <p class="text-sm text-gray-600 mb-4">
                    Anda masuk menggunakan akun Google dan belum mengatur kata sandi untuk akun ini. Atur kata sandi agar Anda juga bisa login secara langsung menggunakan email.
                </p>
                <button @click="sendOtp()" type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" :disabled="isLoading">
                    <span x-text="isLoading ? 'Mengirim...' : 'Kirim OTP ke Email'"></span>
                </button>
                <p x-show="errorMessage" class="text-red-600 text-sm mt-2" x-text="errorMessage"></p>
                <p x-show="successMessage" class="text-green-600 text-sm mt-2" x-text="successMessage"></p>
            </div>

            {{-- Step 2: Input OTP --}}
            <div x-show="step === 2" style="display: none;">
                <p class="text-sm text-gray-600 mb-4">
                    Masukkan kode 6 digit OTP yang telah kami kirimkan ke email Anda.
                </p>
                <div class="mb-4">
                    <label>Kode OTP</label>
                    <input type="text" x-model="otpCode" maxlength="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="123456" />
                </div>
                <div class="flex items-center gap-4">
                    <button @click="verifyOtp()" type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" :disabled="isLoading">
                        <span x-text="isLoading ? 'Memverifikasi...' : 'Verifikasi OTP'"></span>
                    </button>
                    <button @click="step = 1; successMessage = ''" type="button" class="text-sm text-gray-500 hover:text-gray-700">
                        Batal
                    </button>
                </div>
                <p x-show="errorMessage" class="text-red-600 text-sm mt-2" x-text="errorMessage"></p>
            </div>

            {{-- Step 3: Set New Password --}}
            <div x-show="step === 3" style="display: none;" class="space-y-6">
                <div>
                    <label>Kata Sandi Baru</label>
                    <input type="password" x-model="newPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>
                <div>
                    <label>Konfirmasi Kata Sandi Baru</label>
                    <input type="password" x-model="confirmPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>
                <div class="flex items-center gap-4">
                    <button @click="savePassword()" type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" :disabled="isLoading">
                        <span x-text="isLoading ? 'Menyimpan...' : 'Simpan Kata Sandi'"></span>
                    </button>
                </div>
                <p x-show="errorMessage" class="text-red-600 text-sm mt-2" x-text="errorMessage"></p>
                
                {{-- Validasi Error Array dari Backend --}}
                <template x-if="validationErrors">
                    <div class="mt-2 text-sm text-red-600">
                        <template x-for="(errors, field) in validationErrors" :key="field">
                            <template x-for="error in errors">
                                <p x-text="error"></p>
                            </template>
                        </template>
                    </div>
                </template>
            </div>

            {{-- Step 4: Success --}}
            <div x-show="step === 4" style="display: none;" class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                <i class="ri-checkbox-circle-fill text-3xl text-green-500"></i>
                <p class="mt-2 text-green-700 font-medium">Kata sandi Anda berhasil diatur!</p>
                <p class="text-sm text-green-600 mt-1">Silakan <button type="button" class="underline font-bold" onclick="location.reload()">muat ulang halaman</button> untuk memunculkan formulir ubah kata sandi.</p>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('setPasswordFlow', () => ({
                    step: 1,
                    isLoading: false,
                    errorMessage: '',
                    successMessage: '',
                    otpCode: '',
                    newPassword: '',
                    confirmPassword: '',
                    validationErrors: null,

                    async sendOtp() {
                        this.isLoading = true;
                        this.errorMessage = '';
                        this.successMessage = '';
                        try {
                            const response = await fetch('{{ route("profile.set-password-otp.send") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });
                            const data = await response.json();
                            if (response.ok) {
                                this.step = 2;
                                this.successMessage = data.message;
                            } else {
                                this.errorMessage = data.error || 'Terjadi kesalahan.';
                            }
                        } catch (e) {
                            this.errorMessage = 'Gagal terhubung ke server.';
                        } finally {
                            this.isLoading = false;
                        }
                    },

                    async verifyOtp() {
                        if (!this.otpCode) {
                            this.errorMessage = 'Masukkan OTP';
                            return;
                        }
                        this.isLoading = true;
                        this.errorMessage = '';
                        try {
                            const response = await fetch('{{ route("profile.set-password-otp.verify") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ otp_code: this.otpCode })
                            });
                            const data = await response.json();
                            if (response.ok) {
                                this.step = 3;
                            } else {
                                if (data.errors) {
                                    this.errorMessage = Object.values(data.errors)[0][0];
                                } else {
                                    this.errorMessage = data.error || 'Terjadi kesalahan.';
                                }
                            }
                        } catch (e) {
                            this.errorMessage = 'Gagal terhubung ke server.';
                        } finally {
                            this.isLoading = false;
                        }
                    },

                    async savePassword() {
                        this.isLoading = true;
                        this.errorMessage = '';
                        this.validationErrors = null;
                        try {
                            const response = await fetch('{{ route("profile.set-password") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ 
                                    password: this.newPassword,
                                    password_confirmation: this.confirmPassword
                                })
                            });
                            const data = await response.json();
                            if (response.ok) {
                                this.step = 4;
                            } else {
                                if (data.errors) {
                                    this.validationErrors = data.errors;
                                } else {
                                    this.errorMessage = data.error || 'Terjadi kesalahan.';
                                }
                            }
                        } catch (e) {
                            this.errorMessage = 'Gagal terhubung ke server.';
                        } finally {
                            this.isLoading = false;
                        }
                    }
                }))
            })
        </script>
    @endif
</section>
