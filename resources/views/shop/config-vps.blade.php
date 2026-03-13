@extends('layouts.landing')

@section('title', 'Configure VPS')

@section('content')
    <div class="bg-gray-50 min-h-screen pt-28 pb-20" x-data="vpsConfig()">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: KONFIGURASI --}}
            <div class="lg:col-span-2 space-y-6">
                <h1 class="text-2xl font-bold text-gray-800">1. VPS Configuration</h1>
                <p class="text-gray-600">Customize your VPS Plan to fit your needs.</p>

                {{-- Card 1: Billing Cycle --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <label class="block font-bold text-gray-700 mb-2">Billing Cycle</label>
                    <select x-model="billingCycle"
                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-3">
                        <option value="monthly">Monthly</option>
                        <option value="annually">Yearly</option>
                        <option value="biennially">2 Years</option>
                    </select>
                </div>

                {{-- Card 2: OS Selection --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-700 mb-4">Operating System</h3>
                    <div class="space-y-3">
                        <label
                            class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition"
                            :class="os === 'almalinux' ? 'border-blue-500 bg-blue-50' : 'border-gray-200'">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="os" value="almalinux" x-model="os"
                                    class="text-blue-600 focus:ring-blue-500">
                                <span class="font-medium">AlmaLinux</span>
                            </div>
                            <span class="text-xs font-bold text-gray-500 bg-gray-200 px-2 py-1 rounded">FREE</span>
                        </label>

                        <label
                            class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition"
                            :class="os === 'ubuntu' ? 'border-blue-500 bg-blue-50' : 'border-gray-200'">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="os" value="ubuntu" x-model="os"
                                    class="text-blue-600 focus:ring-blue-500">
                                <span class="font-medium">Ubuntu 22.04 LTS</span>
                            </div>
                            <span class="text-xs font-bold text-gray-500 bg-gray-200 px-2 py-1 rounded">FREE</span>
                        </label>

                        <label
                            class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition"
                            :class="os === 'debian' ? 'border-blue-500 bg-blue-50' : 'border-gray-200'">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="os" value="debian" x-model="os"
                                    class="text-blue-600 focus:ring-blue-500">
                                <span class="font-medium">Debian 11</span>
                            </div>
                            <span class="text-xs font-bold text-gray-500 bg-gray-200 px-2 py-1 rounded">FREE</span>
                        </label>
                    </div>
                </div>

                {{-- Card 3: Server Management --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-700 mb-4">Server Management</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border-2 border-blue-500 bg-blue-50 rounded-xl p-4 text-center cursor-pointer">
                            <div class="w-6 h-6 rounded-full border-4 border-blue-600 mx-auto mb-2"></div>
                            <h4 class="font-bold text-blue-700">User-Responsible</h4>
                            <p class="text-xs font-bold text-gray-500 mt-1">FREE</p>
                        </div>
                        <div class="border border-gray-200 rounded-xl p-4 text-center opacity-50 cursor-not-allowed">
                            <div class="w-6 h-6 rounded-full border border-gray-300 mx-auto mb-2"></div>
                            <h4 class="font-bold text-gray-500">Basic</h4>
                            <p class="text-xs text-gray-400 mt-1">Rp 150.000</p>
                        </div>
                        <div class="border border-gray-200 rounded-xl p-4 text-center opacity-50 cursor-not-allowed">
                            <div class="w-6 h-6 rounded-full border border-gray-300 mx-auto mb-2"></div>
                            <h4 class="font-bold text-gray-500">Complete</h4>
                            <p class="text-xs text-gray-400 mt-1">Rp 450.000</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: SUMMARY (Sticky) --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 sticky top-24">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gray-800 rounded flex items-center justify-center text-white">
                            <i class="ri-server-line text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">{{ $productName }}</h3>
                            <p class="text-xs text-gray-500">Configurable Options</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600 border-t border-gray-100 pt-4">
                        <div class="flex justify-between">
                            <span>CPU</span>
                            <span class="font-bold">2 Cores</span>
                        </div>
                        <div class="flex justify-between">
                            <span>RAM</span>
                            <span class="font-bold">2 GB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>OS</span>
                            <span class="font-bold uppercase" x-text="os"></span>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-gray-600 font-medium">Total Estimate</span>
                            <span class="text-2xl font-bold text-blue-600" x-text="formattedTotal"></span>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_name" value="{{ $productName }}">
                            {{-- Menggunakan calculateTotal() agar harga dikirim sesuai pilihan tahun --}}
                            <input type="hidden" name="price" :value="calculateTotal()">
                            <input type="hidden" name="type" value="vps">
                            <input type="hidden" name="os" :value="os">
                            <input type="hidden" name="cycle" :value="billingCycle">

                            <button type="submit"
                                class="w-full py-3 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition shadow-md">
                                Add to Cart <i class="ri-shopping-cart-2-line ml-1"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function vpsConfig() {
            return {
                basePrice: {{ $basePrice }},
                billingCycle: '{{ $cycle }}', // monthly, annually, biennially
                os: 'almalinux',

                calculateTotal() {
                    let multiplier = 1;
                    if (this.billingCycle === 'annually') multiplier = 12;
                    if (this.billingCycle === 'biennially') multiplier = 24;

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
