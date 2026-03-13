@extends('layouts.landing')

@section('title', 'Konfigurasi Domain')

@section('styles')
    <style>
        [x-cloak] { display: none !important; }
        .tab-btn.active { border-bottom: 2px solid #2563EB; color: #2563EB; font-weight: bold; }
        .tab-btn { color: #6B7280; font-weight: 500; border-bottom: 2px solid transparent; }
        .tab-btn:hover { color: #374151; }
    </style>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20" x-data="domainOrder()">
    <div class="max-w-4xl mx-auto px-4">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Konfigurasi Domain</h1>

        {{-- MAIN CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            {{-- TABS NAVIGATION --}}
            <div class="flex border-b border-gray-200">
                <button @click="action = 'register'" class="tab-btn flex-1 py-4 text-center transition" :class="action === 'register' ? 'active' : ''">
                    <i class="ri-add-circle-line mr-1"></i> Register Baru
                </button>
                <button @click="action = 'transfer'" class="tab-btn flex-1 py-4 text-center transition" :class="action === 'transfer' ? 'active' : ''">
                    <i class="ri-arrow-left-right-line mr-1"></i> Transfer Domain
                </button>
                <button @click="action = 'renew'" class="tab-btn flex-1 py-4 text-center transition" :class="action === 'renew' ? 'active' : ''">
                    <i class="ri-refresh-line mr-1"></i> Perpanjang (Renew)
                </button>
            </div>

            <div class="p-8">
                
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    {{-- Hidden Fields --}}
                    <input type="hidden" name="type" value="domain">
                    <input type="hidden" name="action" :value="action"> {{-- Info tambahan untuk backend --}}
                    
                    {{-- 1. TAB REGISTER --}}
                    <div x-show="action === 'register'" x-transition.opacity>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Registrasi Domain Baru</h3>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Domain</label>
                            <input type="text" name="product_name" value="{{ $domainName }}" readonly 
                                   class="w-full bg-gray-100 border border-gray-300 text-gray-600 rounded-lg px-4 py-3 cursor-not-allowed">
                            <p class="text-xs text-green-600 mt-2 flex items-center gap-1">
                                <i class="ri-checkbox-circle-fill"></i> Domain tersedia!
                            </p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (Tahun)</label>
                            <select name="years" x-model="years" class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-blue-500 focus:border-blue-500">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }} Tahun</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- 2. TAB TRANSFER --}}
                    <div x-show="action === 'transfer'" x-cloak>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Transfer Domain ke FutureCloud</h3>
                        
                        <div class="bg-blue-50 border border-blue-100 p-4 rounded-lg mb-6 text-sm text-blue-800">
                            <p><strong>Syarat Transfer:</strong></p>
                            <ul class="list-disc pl-5 mt-1 space-y-1">
                                <li>Domain tidak dalam masa tenggang (expired).</li>
                                <li>Domain sudah terdaftar minimal 60 hari.</li>
                                <li>Status "Theft Protection" di registrar lama sudah dimatikan.</li>
                            </ul>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Domain</label>
                            <input type="text" name="transfer_domain" x-model="inputDomain"
                                   class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-blue-500 focus:border-blue-500" placeholder="contoh: domainanda.com">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode EPP / Auth Code</label>
                            <input type="text" name="epp_code" 
                                   class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan kode dari registrar lama">
                        </div>
                    </div>

                    {{-- 3. TAB RENEW --}}
                    <div x-show="action === 'renew'" x-cloak>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Perpanjang Domain</h3>
                        <p class="text-sm text-gray-500 mb-6">Perpanjang masa aktif domain Anda sebelum kadaluarsa.</p>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Domain</label>
                            <input type="text" name="renew_domain" x-model="inputDomain"
                                   class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-blue-500 focus:border-blue-500" placeholder="contoh: domainanda.com">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Perpanjangan</label>
                            <select name="renew_years" x-model="years" class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-blue-500 focus:border-blue-500">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Tahun</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- SUMMARY & SUBMIT --}}
                    <div class="border-t border-gray-100 pt-6 mt-6 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Estimasi Total:</p>
                            {{-- Logic Harga Sederhana di Frontend --}}
                            <p class="text-2xl font-bold text-blue-600" x-text="formattedTotal"></p>
                            
                            {{-- Hidden Price Input --}}
                            <input type="hidden" name="price" :value="calculateTotal()">
                        </div>
                        
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition flex items-center gap-2">
                            Lanjutkan <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function domainOrder() {
        return {
            // Default Action dari URL ?action=...
            action: '{{ request('action', 'register') }}', 
            
            // Harga Dasar
            basePrice: {{ $price }},
            
            // Inputan
            years: 1,
            inputDomain: '{{ $domainName }}',

            calculateTotal() {
                // Di sini kita pakai harga dasar register dulu untuk simulasi
                // Idealnya harga Transfer/Renew beda, tapi ini MVP
                return this.basePrice * this.years;
            },

            get formattedTotal() {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(this.calculateTotal());
            }
        }
    }
</script>
@endsection