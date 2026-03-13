@extends('layouts.landing')

@section('title', 'Configure Hosting')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20" x-data="cpanelConfig()">
    <div class="max-w-4xl mx-auto px-4">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Configure Hosting</h1>

        <form action="{{ route('cart.add') }}" method="POST"> <!-- ACTION KE CART -->
            @csrf
            
            {{-- DATA HIDDEN UNTUK CART --}}
            <input type="hidden" name="product_name" value="{{ $productName }}">
            <input type="hidden" name="price" value="{{ $basePrice }}">
            <input type="hidden" name="type" value="hosting">
            <input type="hidden" name="cycle" value="{{ $cycle }}">
            <input type="hidden" name="domain" :value="mode === 'new' ? domainResult : existingDomain">
            
            {{-- 1. DOMAIN CONNECTION --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-700 mb-4">1. Domain Connection</h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer transition"
                            :class="mode === 'new' ? 'border-none bg-teal-500 text-white shadow-md' : 'border-gray-200 hover:bg-gray-50'">
                            <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center" :class="mode === 'new' ? 'border-white' : 'border-gray-400'">
                                 <div class="w-2.5 h-2.5 bg-white rounded-full" x-show="mode === 'new'"></div>
                            </div>
                            <input type="radio" name="domain_mode" value="new" x-model="mode" class="hidden">
                            <span class="font-bold">New Domain Name</span>
                        </label>

                        <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer transition"
                            :class="mode === 'existing' ? 'border-none bg-teal-500 text-white shadow-md' : 'border-gray-200 hover:bg-gray-50'">
                            <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center" :class="mode === 'existing' ? 'border-white' : 'border-gray-400'">
                                 <div class="w-2.5 h-2.5 bg-white rounded-full" x-show="mode === 'existing'"></div>
                            </div>
                            <input type="radio" name="domain_mode" value="existing" x-model="mode" class="hidden">
                            <span class="font-bold">Existing Domain Name</span>
                        </label>
                    </div>
                </div>

                <div class="p-8 bg-white">
                    <div x-show="mode === 'new'">
                        <div class="relative">
                            <i class="ri-search-line absolute left-4 top-3.5 text-gray-400 text-xl"></i>
                            <input type="text" x-model="searchQuery" @keydown.enter.prevent="checkDomain()" placeholder="Search domain..." 
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 text-lg">
                        </div>
                        <div class="mt-4" x-show="domainResult">
                             <div class="flex items-center gap-2 p-3 bg-green-50 text-green-700 rounded-lg border border-green-200 font-bold">
                                <i class="ri-checkbox-circle-fill"></i> <span x-text="domainResult"></span> (Available)
                             </div>
                        </div>
                        <button type="button" @click="checkDomain()" class="mt-4 px-6 py-2 bg-teal-500 text-white font-bold rounded-lg hover:bg-teal-600">Check</button>
                    </div>

                    <div x-show="mode === 'existing'" style="display: none;">
                        <div class="relative">
                            <i class="ri-global-line absolute left-4 top-3.5 text-gray-400 text-xl"></i>
                            <input type="text" x-model="existingDomain" placeholder="Enter your domain name" 
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 text-lg">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. DATACENTER LOCATION (NEW) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-700 mb-1">2. Datacenter Location</h3>
                    <p class="text-sm text-gray-500 mb-4">Choose the server location closest to your audience.</p>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {{-- US --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="datacenter" value="US" class="peer hidden" checked>
                            <div class="border border-gray-200 rounded-xl p-4 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 transition hover:shadow-md h-full">
                                <div class="text-3xl mb-2">🇺🇸</div>
                                <div class="font-bold text-gray-800">USA</div>
                                <div class="text-xs text-gray-500">North America</div>
                            </div>
                        </label>
                        {{-- UK --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="datacenter" value="UK" class="peer hidden">
                            <div class="border border-gray-200 rounded-xl p-4 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 transition hover:shadow-md h-full">
                                <div class="text-3xl mb-2">🇬🇧</div>
                                <div class="font-bold text-gray-800">UK</div>
                                <div class="text-xs text-gray-500">Europe</div>
                            </div>
                        </label>
                        {{-- EU --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="datacenter" value="EU" class="peer hidden">
                            <div class="border border-gray-200 rounded-xl p-4 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 transition hover:shadow-md h-full">
                                <div class="text-3xl mb-2">🇪🇺</div>
                                <div class="font-bold text-gray-800">EU</div>
                                <div class="text-xs text-gray-500">Netherlands</div>
                            </div>
                        </label>
                        {{-- SG --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="datacenter" value="SG" class="peer hidden">
                            <div class="border border-gray-200 rounded-xl p-4 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 transition hover:shadow-md h-full">
                                <div class="text-3xl mb-2">🇸🇬</div>
                                <div class="font-bold text-gray-800">Singapore</div>
                                <div class="text-xs text-gray-500">Asia Pacific</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200 flex justify-between items-center">
                <div>
                     <p class="text-sm text-gray-500">Total Price:</p>
                     <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($basePrice, 0, ',', '.') }}</p>
                </div>
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md disabled:opacity-50"
                    :disabled="(mode === 'new' && !domainResult) || (mode === 'existing' && !existingDomain)">
                    Add to Cart <i class="ri-shopping-cart-2-line ml-1"></i>
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function cpanelConfig() {
        return {
            mode: 'new',
            searchQuery: '',
            existingDomain: '',
            domainResult: null,
            checkDomain() {
                if(!this.searchQuery) return;
                let dom = this.searchQuery.toLowerCase();
                if(!dom.includes('.')) dom += '.com';
                this.domainResult = dom;
            }
        }
    }
</script>
@endsection