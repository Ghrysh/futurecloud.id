@extends('layouts.landing')

@section('title', 'Konfigurasi Layanan')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        
        /* CARD STYLES */
        .option-card {
            border: 2px solid #E5E7EB; border-radius: 16px; padding: 24px; cursor: pointer;
            transition: all 0.3s ease; background: white; display: flex; flex-direction: column;
            align-items: center; text-align: center; height: 100%;
        }
        .option-card:hover { border-color: #93C5FD; transform: translateY(-4px); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.1); }
        .option-card.active { border-color: #2563EB; background-color: #EFF6FF; }
        
        .option-icon {
            width: 60px; height: 60px; background: #F3F4F6; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 28px;
            color: #4B5563; margin-bottom: 16px; transition: all 0.3s;
        }
        .option-card:hover .option-icon, .option-card.active .option-icon { background: #2563EB; color: white; }

        .summary-sticky { position: sticky; top: 6rem; }
        .summary-card { background: white; border: 1px solid #E5E7EB; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden; }
        
        .loader { border: 3px solid #f3f3f3; border-top: 3px solid #2563EB; border-radius: 50%; width: 20px; height: 20px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen pt-32 pb-20" x-data="saasConfig()">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KOLOM KIRI: WIZARD --}}
        <div class="lg:col-span-2 space-y-6">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Konfigurasi Layanan</h1>
                <p class="text-gray-500 text-sm mt-1">Hubungkan domain untuk layanan <span class="font-bold text-gray-800">{{ $productName }}</span> Anda.</p>
            </div>
            
            {{-- STEP 1: PILIH METODE --}}
            <div x-show="step === 1" x-transition>
                <h3 class="text-lg font-bold text-gray-800 mb-4">Pilih Opsi Domain</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div @click="setMode('new')" class="option-card">
                        <div class="option-icon"><i class="ri-shopping-cart-2-line"></i></div>
                        <h4 class="font-bold text-gray-900 mb-1">Beli Domain Baru</h4>
                        <p class="text-xs text-gray-500">Cari dan daftarkan domain baru.</p>
                    </div>
                    <div @click="setMode('own_futurecloud')" class="option-card">
                        <div class="option-icon"><i class="ri-folder-user-line"></i></div>
                        <h4 class="font-bold text-gray-900 mb-1">Domain Saya</h4>
                        <p class="text-xs text-gray-500">Gunakan domain yang sudah terdaftar di sini.</p>
                    </div>
                    <div @click="setMode('own_other')" class="option-card">
                        <div class="option-icon"><i class="ri-global-line"></i></div>
                        <h4 class="font-bold text-gray-900 mb-1">Domain Luar</h4>
                        <p class="text-xs text-gray-500">Gunakan domain dari registrar lain.</p>
                    </div>
                </div>
            </div>

            {{-- STEP 2: FORM INPUT --}}
            <div x-show="step === 2" x-cloak class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm relative">
                <button @click="resetStep()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 transition"><i class="ri-close-line text-2xl"></i></button>

                {{-- A. BELI BARU --}}
                <div x-show="mode === 'new'">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2"><i class="ri-search-line text-blue-600"></i> Cari Domain Baru</h3>
                    <div class="flex gap-2">
                        <input type="text" x-model="searchQuery" @keydown.enter.prevent="checkDomain()" class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: namabisnis.com">
                        <button @click="checkDomain()" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition disabled:opacity-50" :disabled="isLoading">
                            <span x-show="!isLoading">Cek</span><span x-show="isLoading" class="loader border-t-white"></span>
                        </button>
                    </div>
                    <div class="mt-4" x-show="domainResult">
                        <div class="flex justify-between items-center p-4 rounded-xl border-2" :class="isAvailable ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'">
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg" x-text="domainResult"></h4>
                                <p class="text-xs font-bold uppercase" :class="isAvailable ? 'text-green-600' : 'text-red-600'" x-text="isAvailable ? 'Tersedia' : 'Sudah Terdaftar'"></p>
                            </div>
                            <div x-show="isAvailable" class="text-right">
                                <span class="font-bold text-blue-600 block text-lg" x-text="formatRupiah(domainPrice)"></span>
                                <button @click="selectDomain(domainResult, domainPrice)" class="text-xs bg-green-600 text-white px-3 py-1.5 rounded-lg mt-1 hover:bg-green-700 font-bold">Pilih Domain Ini</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- B. DOMAIN SENDIRI --}}
                <div x-show="mode === 'own_futurecloud'">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2"><i class="ri-list-check text-blue-600"></i> Pilih Domain Anda</h3>
                    @auth
                        @if(count($userDomains) > 0)
                            <div class="space-y-3 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($userDomains as $dom)
                                    <label class="flex items-center justify-between p-4 border rounded-xl hover:border-blue-500 hover:bg-blue-50 cursor-pointer transition group">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center"><i class="ri-global-line text-lg"></i></div>
                                            <span class="font-bold text-gray-700 group-hover:text-blue-700">{{ $dom }}</span>
                                        </div>
                                        <input type="radio" name="selected_domain" value="{{ $dom }}" @click="selectDomain('{{ $dom }}', 0)" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-xl">
                                <h4 class="font-bold text-gray-800">Belum Ada Domain</h4>
                                <button @click="setMode('new')" class="px-5 py-2 mt-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700">Beli Domain Baru</button>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-10 bg-blue-50 rounded-xl border border-blue-100">
                            <h3 class="text-lg font-bold text-gray-800">Login Diperlukan</h3>
                            <a href="{{ route('login') }}?redirect={{ url()->full() }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-lg mt-2">Login Sekarang</a>
                        </div>
                    @endauth
                </div>

                {{-- C. DOMAIN LUAR --}}
                <div x-show="mode === 'own_other'">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2"><i class="ri-earth-line text-blue-600"></i> Gunakan Domain Eksternal</h3>
                    <div class="flex gap-2">
                        <input type="text" x-model="searchQuery" class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="google.com">
                        <button @click="useExternalDomain()" class="bg-gray-800 text-white px-6 py-3 rounded-xl font-bold hover:bg-gray-900 transition">Gunakan</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: RINGKASAN --}}
        <div class="lg:col-span-1">
            <div class="summary-card summary-sticky">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-white"><i class="ri-shopping-bag-3-line text-xl"></i></div>
                    <div><h3 class="font-bold text-white text-lg">Ringkasan</h3><p class="text-gray-400 text-xs">Detail pesanan Anda</p></div>
                </div>
                
                <div class="p-6">
                    {{-- 1. SAAS ITEM --}}
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="font-bold text-gray-900 text-base">{{ $productName }}</p>
                            <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-2 py-0.5 rounded capitalize">{{ $cycle }}</span>
                        </div>
                        <p class="font-bold text-gray-900" x-text="formatRupiah(saasPrice)"></p>
                    </div>

                    {{-- 2. DOMAIN ITEM (Dinamis) --}}
                    <div x-show="selectedDomain" x-transition class="bg-blue-50 border border-blue-100 rounded-xl p-3 mb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-blue-700 text-sm" x-text="selectedDomain"></p>
                                <p class="text-[10px] text-blue-500 uppercase tracking-wide font-bold" x-text="domainStatusText"></p>
                            </div>
                            <p class="font-bold text-blue-700 text-sm" x-text="formatRupiah(domainPrice)"></p>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-gray-600 font-bold">Total</span>
                        <span class="text-2xl font-extrabold text-blue-600" x-text="formatRupiah(calculateTotal())"></span>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="type" value="saas">
                        <input type="hidden" name="product_name" value="{{ $productName }}">
                        <input type="hidden" name="price" value="{{ $price }}">
                        <input type="hidden" name="cycle" value="{{ $cycle }}">
                        
                        {{-- Field Dinamis --}}
                        <input type="hidden" name="domain" :value="selectedDomain">
                        <input type="hidden" name="domain_mode" :value="mode"> {{-- new, own_futurecloud, own_other --}}
                        
                        <button type="submit" 
                            class="w-full py-3.5 rounded-xl font-bold shadow-lg transition flex items-center justify-center gap-2 transform active:scale-95"
                            :class="selectedDomain ? 'bg-blue-600 text-white hover:bg-blue-700 hover:-translate-y-0.5' : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                            :disabled="!selectedDomain">
                            Lanjut ke Keranjang <i class="ri-arrow-right-line"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function saasConfig() {
        return {
            step: 1, mode: '', searchQuery: '', isLoading: false,
            domainResult: null, isAvailable: false,
            
            // Harga
            saasPrice: {{ $price }},
            domainPrice: 0,
            
            selectedDomain: '',

            get domainStatusText() {
                if(this.mode === 'new') return 'Registrasi Baru (1 Thn)';
                if(this.mode === 'own_futurecloud') return 'Domain Terdaftar';
                return 'Domain Eksternal';
            },

            setMode(mode) {
                this.mode = mode; this.step = 2; this.searchQuery = ''; 
                this.domainResult = null; this.selectedDomain = ''; this.domainPrice = 0;
            },
            resetStep() {
                this.step = 1; this.mode = ''; this.selectedDomain = ''; this.domainPrice = 0;
            },

            async checkDomain() {
                if(!this.searchQuery) return;
                this.isLoading = true; this.domainResult = null;
                let dom = this.searchQuery.toLowerCase(); if(!dom.includes('.')) dom += '.com';

                try {
                    const csrf = document.querySelector('input[name="_token"]').value;
                    const res = await fetch('/check-domain-availability', {
                        method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                        body: JSON.stringify({ domain: dom })
                    });
                    const data = await res.json();
                    
                    if (data.main) {
                        this.domainResult = data.main.domain;
                        this.isAvailable = data.main.available;
                        // Simpan harga integer dari backend
                        this.tempPrice = data.main.price_final; 
                    }
                } catch(e) { console.error(e); } 
                finally { this.isLoading = false; }
            },

            selectDomain(domain, price) {
                this.selectedDomain = domain;
                this.domainPrice = price; // Update harga domain
            },

            useExternalDomain() {
                let dom = this.searchQuery.trim().toLowerCase();
                if (!dom.match(/^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,10}$/)) { customAlert('Format domain salah') return; }
                this.selectDomain(dom, 0); // Domain luar = Gratis (karena sudah punya)
            },

            calculateTotal() {
                return this.saasPrice + this.domainPrice;
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
            }
        }
    }
</script>
@endsection