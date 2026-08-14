@extends('layouts.landing')

@section('title', 'Hubungi Kami')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image with mask --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/contact-hero.webp') }}" alt="Contact Us" class="w-full h-full object-cover opacity-[0.15] mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/95"></div>
        </div>

        {{-- Glow effects --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none z-0">
            <div class="absolute top-10 left-1/4 w-48 h-48 bg-blue-500 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-10 right-1/4 w-64 h-64 bg-cyan-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">Dukungan 24/7</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Hubungi Tim <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">FutureCloud</span>
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Punya pertanyaan tentang layanan kami? Butuh bantuan teknis? Tim support ahli kami siap membantu Anda kapan saja.
            </p>
        </div>
    </section>

    {{-- CONTACT CONTENT --}}
    <section class="scroll-reveal w-full py-24 px-4 bg-white relative">
        <div class="absolute inset-0 z-0 bg-blue-50/50"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16 items-start">
                
                {{-- KOLOM KIRI: FORMULIR (Lebar 3 kolom) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white p-8 md:p-12 rounded-[32px] shadow-2xl border border-gray-100">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Kirim Pesan</h3>
                        <p class="text-gray-600 mb-8">Isi formulir di bawah ini dan kami akan membalas ke email Anda.</p>
                        
                        <form id="contactForm" action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" id="inputName" name="name" 
                                        value="{{ Auth::check() ? Auth::user()->name : old('name') }}" 
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white outline-none transition text-gray-900 placeholder-gray-400 font-medium" 
                                        placeholder="Masukkan nama Anda" required>
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                                    <input type="email" id="inputEmail" name="email" 
                                        value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white outline-none transition text-gray-900 placeholder-gray-400 font-medium" 
                                        placeholder="contoh@email.com" required>
                                </div>
                            </div>
                            
                            {{-- Subject --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek Pesan</label>
                                <select id="inputSubject" name="subject" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white outline-none transition text-gray-900 font-medium" required>
                                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Pilih kategori...</option>
                                    <option value="Pertanyaan Umum" {{ old('subject') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                    <option value="Dukungan Teknis" {{ old('subject') == 'Dukungan Teknis' ? 'selected' : '' }}>Dukungan Teknis</option>
                                    <option value="Tagihan & Pembayaran" {{ old('subject') == 'Tagihan & Pembayaran' ? 'selected' : '' }}>Tagihan & Pembayaran</option>
                                    <option value="Penawaran Kerja Sama" {{ old('subject') == 'Penawaran Kerja Sama' ? 'selected' : '' }}>Penawaran Kerja Sama</option>
                                </select>
                            </div>

                            {{-- Pesan --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Pesan</label>
                                <textarea id="inputMessage" name="message" rows="5" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white outline-none transition text-gray-900 placeholder-gray-400 font-medium resize-y" 
                                    placeholder="Tuliskan detail pertanyaan atau masalah Anda di sini..." required>{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2 mt-4 hover:-translate-y-1">
                                Kirim Pesan <i class="ri-send-plane-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN: INFO KONTAK (Lebar 2 kolom) --}}
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-gray-900 text-white p-8 md:p-10 rounded-[32px] shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-48 h-48 bg-cyan-500/20 rounded-full blur-[60px]"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-6 text-white">Informasi Kontak</h3>
                            
                            <div class="space-y-8">
                                <!-- Address -->
                                <div class="flex items-start gap-5">
                                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 border border-white/10">
                                        <i class="ri-map-pin-2-line text-2xl text-cyan-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-100 text-lg mb-1">Kantor Pusat</h4>
                                        <p class="text-gray-400 leading-relaxed">
                                            Gedung Jaya Lomba 5 unit A.6<br>
                                            JL. M H Thamrin No.12<br>
                                            Jakarta Pusat 10340
                                        </p>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="flex items-start gap-5">
                                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 border border-white/10">
                                        <i class="ri-whatsapp-line text-2xl text-cyan-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-100 text-lg mb-1">Telepon & WhatsApp</h4>
                                        <p class="text-gray-400">(+62) 815-2022-225</p>
                                        <p class="text-gray-500 text-sm mt-1">Senin - Jumat, 09:00 - 17:00</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start gap-5">
                                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 border border-white/10">
                                        <i class="ri-mail-send-line text-2xl text-cyan-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-100 text-lg mb-1">Email Dukungan</h4>
                                        <p class="text-gray-400">info@futurecloud.id</p>
                                        <p class="text-gray-400">support@futurecloud.id</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Map Embed --}}
                    <div class="rounded-[32px] overflow-hidden shadow-2xl border border-gray-100 h-64 relative bg-gray-100 group">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666427009756!2d106.82496467499003!3d-6.175392393811985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764587d%3A0x2cc203666d997d98!2sJakarta%20Pusat%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1709623456789!5m2!1sid!2sid" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="transition-transform duration-700 group-hover:scale-105">
                        </iframe>
                        <div class="absolute inset-0 border-4 border-white rounded-[32px] pointer-events-none"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        // Variable dari Blade untuk cek status login
        const isLoggedIn = @json(Auth::check());
        
        // 1. CEK DRAFT PESAN (Jika user baru login balik)
        const savedDraft = localStorage.getItem('contact_draft');
        if (savedDraft && isLoggedIn) {
            const data = JSON.parse(savedDraft);
            
            // Isi form dengan data yang tersimpan
            // (Kecuali Nama/Email karena sudah auto-fill dari Auth)
            if(document.getElementById('inputSubject')) document.getElementById('inputSubject').value = data.subject || '';
            if(document.getElementById('inputMessage')) document.getElementById('inputMessage').value = data.message || '';
            
            // Hapus draft setelah dipulihkan agar tidak muncul terus
            localStorage.removeItem('contact_draft');
            
            // Notifikasi kecil (Opsional)
            const Toast = Swal.mixin({
                toast: true, position: 'top-end', showConfirmButton: false, timer: 3000
            });
            Toast.fire({ icon: 'info', title: 'Pesan Anda dipulihkan.' });
        }

        // 2. INTERCEPT SUBMIT FORM
        contactForm.addEventListener('submit', function(e) {
            if (!isLoggedIn) {
                e.preventDefault(); // Batalkan submit asli

                // Simpan data input ke LocalStorage
                const formData = {
                    name: document.getElementById('inputName').value,
                    email: document.getElementById('inputEmail').value,
                    subject: document.getElementById('inputSubject').value,
                    message: document.getElementById('inputMessage').value
                };
                localStorage.setItem('contact_draft', JSON.stringify(formData));

                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Login Diperlukan',
                    text: 'Anda harus login terlebih dahulu untuk mengirim pesan. Tenang, pesan Anda tidak akan hilang.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Login Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }
        });

        // 3. NOTIFIKASI SUKSES DARI SERVER
        @if(session('success'))
            Swal.fire({
                title: 'Terkirim!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#2563eb'
            });
        @endif

        // 4. NOTIFIKASI ERROR DARI SERVER
        @if(session('error'))
            Swal.fire({
                title: 'Gagal',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        @endif
    });
</script>
@endsection
