@extends('layouts.landing')

@section('title', 'Gabung Program Partner')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        
        <div class="bg-blue-600 p-8 text-center">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                <i class="ri-shake-hands-line text-3xl text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Partner Registration</h1>
            <p class="text-blue-100 mt-2 text-sm">Lengkapi profil bisnis Anda untuk mulai menjual aplikasi di FutureCloud.</p>
        </div>

        <div class="p-8 md:p-10">
            <form action="{{ route('partner.join.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama Perusahaan / Bisnis -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Perusahaan / Bisnis</label>
                    <div class="relative">
                        <i class="ri-building-4-line absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="text" name="company_name" required 
                               class="w-full border border-gray-300 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                               placeholder="Contoh: PT Teknologi Maju Jaya">
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon / WhatsApp Bisnis</label>
                    <div class="relative">
                        <i class="ri-phone-line absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="text" name="phone_number" required 
                               class="w-full border border-gray-300 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                               placeholder="0812xxxxxxx">
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required 
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                              placeholder="Alamat kantor atau operasional..."></textarea>
                </div>

                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex gap-3 items-start">
                    <i class="ri-information-fill text-blue-600 mt-0.5"></i>
                    <p class="text-xs text-blue-800 leading-relaxed">
                        Dengan mendaftar, akun Anda akan diubah menjadi <strong>Akun Partner</strong>. Anda akan mendapatkan akses ke Dashboard Partner untuk mengelola dan menjual aplikasi SaaS.
                    </p>
                </div>

                <button type="submit" class="w-full py-3.5 bg-blue-600 text-white rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200 transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>

            </form>
        </div>
    </div>
</div>
@endsection