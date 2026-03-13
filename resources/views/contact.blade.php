@extends('layouts.landing')

@section('title', 'Hubungi Kami')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
        }
    </style>
@endsection

@section('content')

    {{-- Hero Header (Responsive Padding & Font) --}}
    <section class="hero-bg w-full pt-24 md:pt-32 pb-12 md:pb-16 px-4 text-center border-b border-gray-100">
        <div class="max-w-4xl mx-auto">
            <span class="text-blue-600 font-bold tracking-wide uppercase text-xs md:text-sm bg-blue-100 px-3 py-1 rounded-full">
                Contact Us
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold mt-4 text-gray-900 leading-tight">
                Hubungi Tim <span class="text-blue-600">FutureCloud</span>
            </h1>
            <p class="mt-4 text-base md:text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Punya pertanyaan tentang layanan kami? Tim support kami siap membantu Anda 24/7.
            </p>
        </div>
    </section>

    {{-- Contact Content --}}
    <section class="w-full py-10 md:py-16 px-4 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto">
            
            {{-- Grid: 1 Kolom di Mobile, 2 Kolom di Desktop --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20">
                
                {{-- KOLOM KIRI: FORMULIR --}}
                <div class="order-1">
                    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                        
                        <form id="contactForm" action="{{ route('contact.send') }}" method="POST" class="space-y-4 md:space-y-5">
                            @csrf
                            
                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="inputName" name="name" 
                                    value="{{ Auth::check() ? Auth::user()->name : old('name') }}" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 md:py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base" 
                                    placeholder="Masukkan nama Anda" required>
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" id="inputEmail" name="email" 
                                    value="{{ Auth::check() ? Auth::user()->email : old('email') }}" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 md:py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base" 
                                    placeholder="nama@email.com" required>
                            </div>

                            {{-- Subjek --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                                <select id="inputSubject" name="subject" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 md:py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-white text-sm md:text-base" required>
                                    <option value="" disabled selected>Pilih topik...</option>
                                    <option value="Sales Inquiry">Pertanyaan Penjualan</option>
                                    <option value="Technical Support">Dukungan Teknis</option>
                                    <option value="Partnership">Kemitraan</option>
                                    <option value="Other">Lainnya</option>
                                </select>
                            </div>

                            {{-- Pesan --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                                <textarea id="inputMessage" name="message" rows="5" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 md:py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base" 
                                    placeholder="Tuliskan detail pertanyaan Anda di sini..." required>{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 md:py-3.5 rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg transform active:scale-95 text-sm md:text-base">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN: INFO KONTAK --}}
                <div class="space-y-8 order-2 lg:order-2">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Informasi Kontak</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            Jangan ragu untuk menghubungi kami secara langsung. Kami akan merespons secepat mungkin pada jam kerja.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                                <i class="ri-map-pin-2-fill text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">Kantor Pusat</h4>
                                <p class="text-gray-600 text-xs md:text-sm mt-1">
                                    Gedung Jaya Lomba 5 unit A.6<br>
                                    JL. M H Thamrin No.12, Jakarta Pusat 10340
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                                <i class="ri-whatsapp-fill text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">WhatsApp & Telepon</h4>
                                <p class="text-gray-600 text-xs md:text-sm mt-1">(+62) 815-2022-225</p>
                                <p class="text-gray-500 text-[10px] md:text-xs">Senin - Jumat, 09:00 - 17:00</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center shrink-0">
                                <i class="ri-mail-send-fill text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">Email</h4>
                                <p class="text-gray-600 text-xs md:text-sm mt-1 break-all">info@futurecloud.id</p>
                                <p class="text-gray-600 text-xs md:text-sm break-all">support@futurecloud.id</p>
                            </div>
                        </div>
                    </div>

                    {{-- Map Embed (Responsive Height) --}}
                    <div class="rounded-xl overflow-hidden shadow-sm border border-gray-200 h-56 md:h-64 bg-gray-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666427009756!2d106.82496467499003!3d-6.175392393811985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764587d%3A0x2cc203666d997d98!2sJakarta%20Pusat%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1709623456789!5m2!1sid!2sid" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
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