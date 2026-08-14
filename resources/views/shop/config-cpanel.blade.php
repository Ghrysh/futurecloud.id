@extends('layouts.landing')

@section('title', 'Konfigurasi Hosting')

@section('content')
<div class="bg-slate-50 min-h-screen pt-28 pb-24 relative overflow-hidden font-['Inter']" x-data="hostingConfig()">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-yellow-50 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10 scroll-reveal">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Konfigurasi Cloud Hosting</h1>
            <p class="text-slate-500 mt-3 font-medium">Atur detail layanan hosting Anda sebelum menambahkannya ke keranjang.</p>
        </div>

        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="hosting">
            <input type="hidden" name="product_name" value="{{ $productName }}">
            <input type="hidden" name="price" :value="calculateTotal()">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: KONFIGURASI --}}
                <div class="lg:col-span-2 space-y-6 scroll-reveal">
                    
                    {{-- 1. PILIH DATACENTER --}}
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="ri-map-pin-line text-blue-600"></i> Lokasi Datacenter
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            {{-- Singapore --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="datacenter === 'sg' ? 'border-blue-600 bg-blue-50/50 shadow-sm' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="datacenter" value="sg" x-model="datacenter" class="sr-only">
                                <span class="text-2xl mb-2">🇸🇬</span>
                                <span class="font-bold text-sm text-slate-700 text-center">Singapore</span>
                                <div x-show="datacenter === 'sg'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>

                            {{-- Indonesia --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="datacenter === 'id' ? 'border-blue-600 bg-blue-50/50 shadow-sm' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="datacenter" value="id" x-model="datacenter" class="sr-only">
                                <span class="text-2xl mb-2">🇮🇩</span>
                                <span class="font-bold text-sm text-slate-700 text-center">Indonesia</span>
                                <div x-show="datacenter === 'id'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>

                            {{-- USA --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="datacenter === 'us' ? 'border-blue-600 bg-blue-50/50 shadow-sm' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="datacenter" value="us" x-model="datacenter" class="sr-only">
                                <span class="text-2xl mb-2">🇺🇸</span>
                                <span class="font-bold text-sm text-slate-700 text-center">USA</span>
                                <div x-show="datacenter === 'us'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- 2. DOMAIN CONNECTION --}}
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="ri-global-line text-blue-600"></i> Domain yang digunakan
                        </h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Masukkan Nama Domain</label>
                            <input type="text" name="domain" placeholder="contoh: namabisnis.com" required
                                   class="w-full border-slate-300 rounded-xl px-4 py-3 focus:ring-blue-500 focus:border-blue-500 bg-slate-50">
                            <p class="text-xs text-slate-500 mt-2">Domain ini akan dihubungkan dengan paket hosting Anda. Anda bisa mendaftarkan domain baru di halaman Domain jika belum memilikinya.</p>
                        </div>
                    </div>

                    {{-- 3. SIKLUS TAGIHAN --}}
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="ri-calendar-line text-blue-600"></i> Siklus Tagihan
                        </h3>
                        
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-4 border-2 rounded-2xl cursor-pointer transition-all"
                                :class="billingCycle === 'monthly' ? 'border-blue-600 bg-blue-50/50 shadow-sm' : 'border-slate-200 hover:border-blue-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="cycle" value="monthly" x-model="billingCycle" class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <span class="block font-bold text-slate-700">Bulanan</span>
                                        <span class="text-xs text-slate-500">Bayar setiap bulan</span>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="flex items-center justify-between p-4 border-2 rounded-2xl cursor-pointer transition-all"
                                :class="billingCycle === 'annually' ? 'border-blue-600 bg-blue-50/50 shadow-sm' : 'border-slate-200 hover:border-blue-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="cycle" value="annually" x-model="billingCycle" class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <span class="block font-bold text-slate-700">Tahunan</span>
                                        <span class="text-xs text-emerald-600 font-medium flex items-center gap-1"><i class="ri-percent-line"></i> Gratis Domain + Hemat 20%</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: RINGKASAN --}}
                <div class="lg:col-span-1 scroll-reveal" style="transition-delay: 100ms;">
                    <div class="bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-lg border border-slate-200 sticky top-32">
                        <h3 class="font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Ringkasan Pesanan</h3>
                        
                        <div class="mb-6">
                            <div class="text-lg font-black text-slate-800">{{ $productName }}</div>
                            <div class="text-sm text-slate-500 uppercase tracking-wider mt-1 font-bold">Cloud Hosting</div>
                        </div>

                        <div class="space-y-3 text-sm text-slate-600 border-t border-slate-100 pt-4 mb-8">
                            <div class="flex justify-between">
                                <span>Control Panel</span>
                                <span class="font-bold">cPanel</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Datacenter</span>
                                <span class="font-bold uppercase" x-text="datacenter"></span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 mb-6">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Biaya</p>
                            <p class="text-3xl font-black text-blue-600" x-text="formattedTotal"></p>
                        </div>
                        
                        <button type="submit" class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            Tambah ke Keranjang <i class="ri-shopping-cart-2-line"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
    function hostingConfig() {
        return {
            basePrice: {{ (float) $basePrice }},
            billingCycle: '{{ $cycle }}', 
            datacenter: 'sg',

            calculateTotal() {
                let multiplier = 1;
                if (this.billingCycle === 'annually') multiplier = 12; // In real life, calculate discount here
                return this.basePrice * multiplier;
            },

            get formattedTotal() {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(this.calculateTotal());
            }
        }
    }
</script>
@endsection
