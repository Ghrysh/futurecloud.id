@extends('layouts.landing')

@section('title', 'Konfigurasi VPS')

@section('content')
<div class="bg-slate-50 min-h-screen pt-28 pb-24 relative overflow-hidden font-['Inter']" x-data="vpsConfig()">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-50 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10 scroll-reveal">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Konfigurasi Cloud VPS</h1>
            <p class="text-slate-500 mt-3 font-medium text-lg">Atur spesifikasi virtual server Anda sebelum menambahkannya ke keranjang.</p>
        </div>

        <form action="{{ route('cart.add') }}" method="POST" id="vpsForm">
            @csrf
            <input type="hidden" name="type" value="vps">
            <input type="hidden" name="product_name" value="{{ $productName }}">
            <input type="hidden" name="price" :value="calculateTotal()">
            
            {{-- Tambahan Hidden Input untuk Hostname & OS agar tersimpan di configuration --}}
            <input type="hidden" name="domain" :value="hostname"> {{-- menggunakan kolom domain untuk hostname --}}
            <input type="hidden" name="action" :value="os"> {{-- menggunakan kolom action untuk OS --}}
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: KONFIGURASI --}}
                <div class="lg:col-span-2 space-y-6 scroll-reveal">
                    
                    {{-- 0. HOSTNAME --}}
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="ri-global-line text-blue-600"></i> Hostname Server
                        </h3>
                        <div>
                            <input type="text" x-model="hostname" placeholder="server.domainanda.com" class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 block p-4 outline-none transition font-medium" required>
                            <p class="text-xs text-slate-500 mt-2"><i class="ri-information-line"></i> Masukkan FQDN (Fully Qualified Domain Name) yang valid.</p>
                        </div>
                    </div>

                    {{-- 1. PILIH OS --}}
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="ri-ubuntu-line text-blue-600"></i> Sistem Operasi
                        </h3>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            {{-- Ubuntu --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="os === 'ubuntu' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="os_radio" value="ubuntu" x-model="os" class="sr-only">
                                <i class="ri-ubuntu-fill text-4xl mb-2" :class="os === 'ubuntu' ? 'text-orange-500' : 'text-slate-400'"></i>
                                <span class="font-bold text-sm text-slate-700 text-center">Ubuntu 22.04</span>
                                <div x-show="os === 'ubuntu'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>

                            {{-- Debian --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="os === 'debian' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="os_radio" value="debian" x-model="os" class="sr-only">
                                <i class="ri-centos-fill text-4xl mb-2" :class="os === 'debian' ? 'text-red-500' : 'text-slate-400'"></i>
                                <span class="font-bold text-sm text-slate-700 text-center">Debian 11</span>
                                <div x-show="os === 'debian'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>

                            {{-- AlmaLinux --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="os === 'almalinux' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="os_radio" value="almalinux" x-model="os" class="sr-only">
                                <i class="ri-server-line text-4xl mb-2" :class="os === 'almalinux' ? 'text-blue-500' : 'text-slate-400'"></i>
                                <span class="font-bold text-sm text-slate-700 text-center">AlmaLinux</span>
                                <div x-show="os === 'almalinux'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>
                            
                            {{-- Windows --}}
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="os === 'windows' ? 'border-blue-600 bg-blue-50 shadow-md ring-4 ring-blue-500/20 scale-105' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="os_radio" value="windows" x-model="os" class="sr-only">
                                <i class="ri-windows-fill text-4xl mb-2" :class="os === 'windows' ? 'text-blue-600' : 'text-slate-400'"></i>
                                <span class="font-bold text-sm text-slate-700 text-center">Windows</span>
                                <div x-show="os === 'windows'" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- 2. SIKLUS TAGIHAN --}}
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
                                        <span class="text-sm text-emerald-600 font-bold flex items-center gap-1 bg-emerald-100 px-2 py-0.5 rounded-full mt-1 w-max"><i class="ri-percent-line"></i> Hemat 15%</span>
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
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold uppercase tracking-widest" x-text="os"></span>
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold tracking-widest" x-text="hostname ? hostname : 'No Hostname'"></span>
                            </div>
                        </div>

                        <div class="space-y-4 text-sm text-slate-600 border-t border-slate-100 pt-6 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="flex items-center gap-2"><i class="ri-settings-4-line text-slate-400"></i> Manajemen</span>
                                <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">Self-managed</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="flex items-center gap-2"><i class="ri-map-pin-line text-slate-400"></i> Lokasi</span>
                                <span class="font-bold text-slate-800 bg-slate-100 px-2 py-0.5 rounded">Singapore</span>
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
    function vpsConfig() {
        return {
            basePrice: {{ (float) $basePrice }},
            billingCycle: '{{ $cycle }}', 
            os: 'ubuntu',
            hostname: '',

            calculateTotal() {
                let multiplier = 1;
                if (this.billingCycle === 'annually') multiplier = 12; 
                let total = this.basePrice * multiplier;
                if (this.billingCycle === 'annually') {
                    // 15% discount for annual
                    total = total - (total * 0.15);
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
