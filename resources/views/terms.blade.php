@extends('layouts.landing')

@section('title', 'Terms of Service')

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full pt-32 pb-24 px-4 text-center bg-[#0a192f] text-white relative overflow-hidden">
        {{-- Background Image with mask --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/terms-hero.jpg') }}" alt="Terms Background" class="w-full h-full object-cover opacity-[0.15] mix-blend-screen">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0a192f]/95"></div>
        </div>

        {{-- Glow effects --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none z-0">
            <div class="absolute top-10 left-10 w-64 h-64 bg-blue-600 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-cyan-400 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 scroll-reveal">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-900/40 border border-blue-500/30 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">Informasi Legal</span>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Syarat & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Ketentuan</span>
            </h1>

            <p class="text-blue-100 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed px-4">
                Terakhir diperbarui: {{ date('d F Y') }}
            </p>
        </div>
    </section>

    {{-- TERMS CONTENT --}}
    <main class="w-full py-24 bg-slate-50 min-h-screen relative font-['Inter']">
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-[900px] mx-auto px-4 sm:px-6 relative z-10 space-y-8">

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">1</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Pendahuluan</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    Selamat datang di FutureCloud, platform layanan infrastruktur digital yang dikelola oleh PT Berkah Teknologi Terdepan. Dengan mengakses, mendaftar, dan menggunakan layanan kami, Anda setuju untuk terikat oleh Syarat & Ketentuan ini. Jika Anda tidak setuju, Anda dilarang menggunakan layanan kami.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">2</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Layanan Kami</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    FutureCloud menyediakan penyewaan Cloud, Virtual Private Server (VPS), Domain, Hosting Terkelola, serta layanan SaaS (Software as a Service) lainnya. Kami berhak mengubah spesifikasi, menangguhkan, atau menghentikan layanan kapan saja untuk pemeliharaan atau alasan teknis.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">3</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Akun dan Keamanan</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    Anda bertanggung jawab penuh untuk memberikan informasi yang valid saat pendaftaran dan menjaga kerahasiaan kredensial login (Email & Password) Anda. FutureCloud tidak bertanggung jawab atas akses yang tidak sah ke dalam server atau akun Anda akibat kelalaian pelanggan.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">4</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Pembayaran dan Tagihan</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    Sistem kami menggunakan sistem prabayar (pre-paid). Layanan berbayar ditagihkan sesuai dengan siklus yang Anda pilih. Jika pembayaran tidak diterima selambat-lambatnya pada tanggal jatuh tempo, layanan Anda (VPS/Hosting/Domain) akan ditangguhkan dan dihapus dari sistem secara otomatis.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center shrink-0 border border-red-100">
                        <span class="text-xl font-black text-red-600">5</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Penggunaan yang Dilarang</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium mb-4">
                    Dengan menyewa server atau menggunakan layanan di FutureCloud, Anda dilarang keras untuk:
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Menggunakan layanan untuk tujuan ilegal atau melanggar hukum Republik Indonesia dan Internasional.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Menyebarkan malware, ransomware, botnet, atau aktivitas peretasan (hacking, port scanning, DDoS).</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Melakukan spam email atau pengiriman pesan massal yang tidak sah.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ri-close-circle-fill text-red-500 mt-1 shrink-0"></i>
                        <span class="text-base text-slate-600 font-medium">Meng-host web phising, penipuan, perjudian online, atau konten bajakan tanpa lisensi.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center shrink-0 border border-orange-100">
                        <span class="text-xl font-black text-orange-600">6</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Penghentian Layanan & Sanksi</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    FutureCloud berhak membatalkan, mensuspend, atau menghapus layanan (Server/Hosting) secara sepihak dan tanpa peringatan apabila ditemukan adanya pelanggaran berat terhadap Syarat & Ketentuan ini. Dalam kasus ini, tidak ada pengembalian dana (refund) yang akan diberikan.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 shadow-lg shadow-blue-900/5 scroll-reveal hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                        <span class="text-xl font-black text-blue-600">7</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Hukum yang Berlaku</h2>
                </div>
                <p class="text-base text-slate-600 leading-relaxed font-medium">
                    Syarat & Ketentuan ini tunduk pada hukum Republik Indonesia. Setiap sengketa akan diselesaikan melalui musyawarah untuk mufakat.
                </p>
            </div>

            <div class="bg-slate-900 text-white rounded-3xl border border-slate-800 p-8 md:p-10 shadow-2xl scroll-reveal relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-[80px]"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-800">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/10">
                            <i class="ri-customer-service-2-line text-2xl text-blue-400"></i>
                        </div>
                        <h2 class="text-xl md:text-2xl font-bold text-white tracking-tight">Kontak Bantuan</h2>
                    </div>
                    <div class="space-y-4">
                        <p class="text-base text-slate-300 leading-relaxed font-medium">
                            <span class="font-bold text-white">PT Berkah Teknologi Terdepan</span><br>
                            Gedung Jaya Lomba 5 unit A.6<br>
                            Jl. M H Thamrin No.12, RT.002/RW.001<br>
                            Kb. Sirih, Kec. Menteng, Jakarta Pusat 10340
                        </p>
                        <div class="pt-2">
                            <a href="mailto:support@futurecloud.id" class="inline-flex items-center gap-2 text-blue-400 font-bold hover:text-blue-300 transition-colors">
                                <i class="ri-mail-send-line"></i> support@futurecloud.id
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
