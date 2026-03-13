@extends('layouts.landing')

@section('title', 'Pricing & Plans')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .pricing-card { transition: all 0.3s ease; }
        .pricing-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1); }
    </style>
@endsection

@section('content')

    {{-- HERO --}}
    <section class="w-full pt-32 pb-16 px-4 bg-gradient-to-b from-white to-blue-50 text-center border-b border-gray-100">
        <div class="max-w-4xl mx-auto">
            <span class="text-blue-600 font-bold tracking-wide uppercase text-sm bg-blue-100 px-3 py-1 rounded-full">Katalog Layanan</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mt-4 text-gray-900 leading-tight">
                Pilih Paket <span class="text-blue-600">Terbaik Anda</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600">Pilih layanan yang Anda butuhkan untuk memulai proyek Anda.</p>
        </div>
    </section>

    {{-- TAB NAVIGATION --}}
    <section class="sticky top-16 z-30 bg-white/90 backdrop-blur-md border-b border-gray-100 py-4 shadow-sm">
        <div class="flex justify-center gap-2 overflow-x-auto px-4">
            <button onclick="showSection('vps')" id="btn-vps" class="tab-btn px-6 py-2 bg-blue-600 text-white rounded-full text-sm font-bold shadow-md transition">VPS Hosting</button>
            <button onclick="showSection('hosting')" id="btn-hosting" class="tab-btn px-6 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-medium hover:bg-gray-50 transition">Web Hosting</button>
            <button onclick="showSection('domain')" id="btn-domain" class="tab-btn px-6 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-medium hover:bg-gray-50 transition">Domain</button>
        </div>
    </section>

    <div class="bg-white py-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 1. VPS SECTION --}}
            <div id="section-vps" class="tab-content block">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold text-gray-900">Paket VPS Cloud</h2>
                    <p class="text-gray-500">Performa dedikasi untuk aplikasi berat.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($vpsPlans as $plan)
                        <div class="pricing-card bg-white border {{ isset($plan['best_seller']) ? 'border-blue-500 ring-2 ring-blue-100' : 'border-gray-200' }} rounded-2xl p-8 relative flex flex-col">
                            @if(isset($plan['best_seller']))
                                <span class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-bl-xl rounded-tr-xl">POPULER</span>
                            @endif
                            <h3 class="text-lg font-bold text-gray-900">{{ $plan['name'] }}</h3>
                            <div class="my-4">
                                <span class="text-3xl font-extrabold text-gray-900">Rp {{ number_format($plan['price'], 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-sm">/bln</span>
                            </div>
                            <ul class="space-y-3 mb-8 flex-1 text-sm text-gray-600">
                                <li class="flex gap-2"><i class="ri-cpu-line text-blue-500"></i> {{ $plan['cpu'] }} CPU</li>
                                <li class="flex gap-2"><i class="ri-ram-2-line text-blue-500"></i> {{ $plan['ram'] }} RAM</li>
                                <li class="flex gap-2"><i class="ri-hard-drive-2-line text-blue-500"></i> {{ $plan['ssd'] }} SSD</li>
                            </ul>
                            
                            {{-- FORM BELI (SIMULASI) --}}
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_name" value="{{ $plan['name'] }}">
                                <input type="hidden" name="price" value="{{ $plan['price'] }}">
                                <input type="hidden" name="type" value="vps">
                                <button type="submit" class="w-full py-3 rounded-xl font-bold transition {{ isset($plan['best_seller']) ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-blue-50 text-blue-600 hover:bg-blue-100' }}">
                                    Pilih Paket
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 2. HOSTING SECTION --}}
            <div id="section-hosting" class="tab-content hidden">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold text-gray-900">Web Hosting</h2>
                    <p class="text-gray-500">Cocok untuk website personal dan UMKM.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    @foreach($hostingPlans as $plan)
                        <div class="pricing-card bg-white border {{ isset($plan['best_seller']) ? 'border-blue-500' : 'border-gray-200' }} rounded-2xl p-8 flex flex-col">
                            <h3 class="text-lg font-bold text-gray-900">{{ $plan['name'] }}</h3>
                            <div class="my-4">
                                <span class="text-3xl font-extrabold text-gray-900">Rp {{ number_format($plan['price'], 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-sm">/bln</span>
                            </div>
                            <ul class="space-y-3 mb-8 flex-1 text-sm text-gray-600">
                                <li class="flex gap-2"><i class="ri-hard-drive-line text-blue-500"></i> Disk: {{ $plan['space'] }}</li>
                                <li class="flex gap-2"><i class="ri-global-line text-blue-500"></i> Free SSL</li>
                                <li class="flex gap-2"><i class="ri-mail-send-line text-blue-500"></i> Unlimited Email</li>
                            </ul>
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_name" value="{{ $plan['name'] }}">
                                <input type="hidden" name="price" value="{{ $plan['price'] }}">
                                <input type="hidden" name="type" value="hosting">
                                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
                                    Beli Hosting
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 3. DOMAIN SECTION --}}
            <div id="section-domain" class="tab-content hidden">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold text-gray-900">Registrasi Domain</h2>
                    <p class="text-gray-500">Amankan nama brand Anda sekarang.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($domainPlans as $plan)
                        <div class="pricing-card bg-white border border-gray-200 rounded-xl p-6 flex flex-col items-center text-center hover:border-blue-300">
                            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4 text-blue-600 font-bold text-xl">
                                {{ $plan['ext'] }}
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $plan['name'] }}</h3>
                            <p class="text-2xl font-bold text-gray-800 mb-6">Rp {{ number_format($plan['price'], 0, ',', '.') }}</p>
                            
                            <form action="{{ route('order.store') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="product_name" value="Domain {{ $plan['ext'] }}">
                                <input type="hidden" name="price" value="{{ $plan['price'] }}">
                                <input type="hidden" name="type" value="domain">
                                <button type="submit" class="w-full py-2 border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                                    Daftar
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
<script>
    function showSection(id) {
        // Hide All
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
            el.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        });

        // Show Selected
        document.getElementById('section-' + id).classList.remove('hidden');
        const activeBtn = document.getElementById('btn-' + id);
        activeBtn.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-md');
    }
</script>
@endsection