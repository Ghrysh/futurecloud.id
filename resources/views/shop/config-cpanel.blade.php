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
            <p class="text-slate-500 mt-3 font-medium text-lg">Atur detail layanan hosting Anda sebelum menambahkannya ke keranjang.</p>
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
                                :class="datacenter === 'sg' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="datacenter" value="sg" x-model="datacenter" class="sr-only">
                                <span class="text-4xl mb-2">🇸🇬</span>
                                <span class="font-bold text-sm text-slate-700 text-center">Singapore</span>
                                <div x-show="datacenter === 'sg'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>

                            {{-- Indonesia --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="datacenter === 'id' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="datacenter" value="id" x-model="datacenter" class="sr-only">
                                <span class="text-4xl mb-2">🇮🇩</span>
                                <span class="font-bold text-sm text-slate-700 text-center">Indonesia</span>
                                <div x-show="datacenter === 'id'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>

                            {{-- USA --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="datacenter === 'us' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="datacenter" value="us" x-model="datacenter" class="sr-only">
                                <span class="text-4xl mb-2">🇺🇸</span>
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
                            <i class="ri-global-line text-blue-600"></i> Domain Utama
                        </h3>
                        
                        <div>
                            <input type="text" name="domain" x-model="domainName" placeholder="contoh: namabisnis.com" required
                                   class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 block p-4 outline-none transition font-medium">
                            <p class="text-xs text-slate-500 mt-2"><i class="ri-information-line"></i> Domain ini akan dihubungkan dengan paket hosting Anda. Anda bisa mendaftarkan domain baru di halaman pencarian Domain.</p>
                        </div>
                    </div>

                    {{-- 3. SIKLUS TAGIHAN --}}
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="ri-calendar-line text-blue-600"></i> Siklus Tagihan
                        </h3>
                        
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-5 border-2 rounded-2xl cursor-pointer transition-all"
                                :class="billingCycle === 'monthly' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/10' : 'border-slate-200 bg-white hover:border-blue-300'">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center" :class="billingCycle === 'monthly' ? 'border-blue-600 bg-blue-600' : 'border-slate-300'">
                                        <div class="w-2 h-2 rounded-full bg-white" x-show="billingCycle === 'monthly'"></div>
                                    </div>
                                    <input type="radio" name="cycle" value="monthly" x-model="billingCycle" class="sr-only">
                                    <div>
                                        <span class="block font-bold text-slate-800 text-lg">Bulanan</span>
                                        <span class="text-sm text-slate-500">Bayar setiap bulan</span>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="flex items-center justify-between p-5 border-2 rounded-2xl cursor-pointer transition-all"
                                :class="billingCycle === 'annually' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/10' : 'border-slate-200 bg-white hover:border-blue-300'">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center" :class="billingCycle === 'annually' ? 'border-blue-600 bg-blue-600' : 'border-slate-300'">
                                        <div class="w-2 h-2 rounded-full bg-white" x-show="billingCycle === 'annually'"></div>
                                    </div>
                                    <input type="radio" name="cycle" value="annually" x-model="billingCycle" class="sr-only">
                                    <div>
                                        <span class="block font-bold text-slate-800 text-lg">Tahunan</span>
                                        <span class="text-sm text-emerald-600 font-bold flex items-center gap-1 bg-emerald-100 px-2 py-0.5 rounded-full mt-1 w-max"><i class="ri-percent-line"></i> Hemat 20%</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: RINGKASAN --}}
                <div class="lg:col-span-1 scroll-reveal" style="transition-delay: 100ms;">
                    <div class="bg-white/90 backdrop-blur-xl p-8 rounded-3xl shadow-xl border border-slate-200 sticky top-32">
                        <h3 class="font-extrabold text-xl text-slate-900 mb-6 border-b border-slate-100 pb-4">Ringkasan Pesanan</h3>
                        
                        <div class="mb-6">
                            <div class="text-2xl font-black text-blue-600">{{ $productName }}</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold uppercase tracking-widest" x-text="datacenter"></span>
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold tracking-widest" x-text="domainName ? domainName : 'No Domain'"></span>
                            </div>
                        </div>

                        <div class="space-y-4 text-sm text-slate-600 border-t border-slate-100 pt-6 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="flex items-center gap-2"><i class="ri-settings-4-line text-slate-400"></i> Control Panel</span>
                                <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">cPanel</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="flex items-center gap-2"><i class="ri-database-2-line text-slate-400"></i> Penyimpanan</span>
                                <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">NVMe SSD</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="flex items-center gap-2"><i class="ri-timer-line text-slate-400"></i> Setup</span>
                                <span class="font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded">Instan</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-200 mb-8 bg-slate-50 -mx-8 px-8 pb-8 rounded-b-3xl">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 pt-6">Total Biaya</p>
                            <p class="text-4xl font-black text-slate-900" x-text="formattedTotal"></p>
                            <p class="text-sm text-slate-500 mt-2">Belum termasuk PPN 11%</p>
                            
                            <button type="submit" class="w-full mt-6 py-4 bg-blue-600 text-white font-bold text-lg rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                                <i class="ri-shopping-cart-2-line"></i> Masukkan Keranjang 
                            </button>
                        </div>
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
            domainName: '',

            calculateTotal() {
                let multiplier = 1;
                if (this.billingCycle === 'annually') multiplier = 12; 
                let total = this.basePrice * multiplier;
                if (this.billingCycle === 'annually') {
                    // 20% discount for annual
                    total = total - (total * 0.20);
                }
                return total;
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
