@extends('layouts.landing')

@section('title', 'Konfigurasi Domain')

@section('content')
<div class="bg-slate-50 min-h-screen pt-28 pb-24 relative overflow-hidden font-['Inter']" x-data="domainOrder()">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] bg-cyan-50 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10 scroll-reveal">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Konfigurasi Domain</h1>
            <p class="text-slate-500 mt-3 font-medium">Atur detail pendaftaran domain Anda sebelum menambahkannya ke keranjang.</p>
        </div>

        {{-- MAIN CARD --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-blue-900/5 border border-white scroll-reveal">
            <form action="{{ route('cart.add') }}" method="POST" class="p-8 md:p-10">
                @csrf
                <input type="hidden" name="type" value="domain">
                <input type="hidden" name="action" :value="action">
                
                {{-- INFO DOMAIN --}}
                <div class="flex items-center gap-4 mb-8 pb-8 border-b border-slate-100">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 shadow-inner shrink-0">
                        <i class="ri-global-line text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 truncate" x-text="inputDomain"></h2>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="flex items-center justify-center w-4 h-4 rounded-full bg-emerald-100 text-emerald-600">
                                <i class="ri-check-line text-[10px] font-bold"></i>
                            </span>
                            <span class="text-sm font-bold text-emerald-600">Tersedia untuk Didaftarkan</span>
                        </div>
                    </div>
                </div>

                {{-- FORM DURASI --}}
                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-4">Pilih Durasi Pendaftaran</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <template x-for="y in [1, 2, 3]" :key="y">
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-300"
                                :class="years == y ? 'border-blue-600 bg-blue-50/50 shadow-md shadow-blue-900/5' : 'border-slate-200 bg-white hover:border-blue-300 hover:bg-slate-50'">
                                <input type="radio" name="years" :value="y" x-model="years" class="sr-only">
                                
                                <span class="text-lg font-black" :class="years == y ? 'text-blue-700' : 'text-slate-700'" x-text="y + ' Tahun'"></span>
                                <span class="text-xs font-semibold mt-1" :class="years == y ? 'text-blue-500' : 'text-slate-400'">
                                    <span x-show="y == 1">Harga Standar</span>
                                    <span x-show="y > 1" x-text="'Lebih Hemat'"></span>
                                </span>
                                
                                <div x-show="years == y" class="absolute -top-2 -right-2 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-sm">
                                    <i class="ri-check-line text-sm"></i>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="product_name" value="{{ $domainName }}">
                </div>

                {{-- SUMMARY & SUBMIT --}}
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-6 mt-8">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Biaya</p>
                        <p class="text-3xl font-black text-blue-600" x-text="formattedTotal"></p>
                        <input type="hidden" name="price" :value="calculateTotal()">
                    </div>
                    
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2 text-lg">
                        Tambah ke Keranjang <i class="ri-shopping-cart-2-line"></i>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    function domainOrder() {
        return {
            action: '{{ request('action', 'register') }}', 
            basePrice: {{ (float) $price }},
            years: 1,
            inputDomain: '{{ $domainName }}',

            calculateTotal() {
                return this.basePrice * this.years;
            },

            get formattedTotal() {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(this.calculateTotal());
            }
        }
    }
</script>
@endsection
