@extends('layouts.landing')

@section('title', $app->name)

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .sticky-sidebar { position: sticky; top: 6rem; }
        .hero-img { width: 100%; height: 100%; object-fit: cover; border-radius: 12px; }
        [x-cloak] { display: none !important; }
        
        /* --- FUTURECLOUD CARD STYLE --- */
        
        /* 1. SSL CARD STYLE (Clean White & Blue) */
        .ssl-card {
            background-color: #ffffff;
            color: #374151; /* Gray-700 */
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid #e5e7eb; /* Border abu tipis */
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .ssl-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.15); /* Bayangan Biru */
            border-color: #2563EB; /* Border Biru saat hover */
        }
        .ssl-badge {
            background-color: #2563EB; /* Biru FutureCloud */
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 4px 10px;
            position: absolute;
            top: 0; left: 0;
            border-bottom-right-radius: 12px;
            z-index: 10;
        }
        .ssl-price { font-size: 28px; font-weight: 800; color: #1e40af; /* Blue-800 */ }
        .ssl-btn {
            background-color: #2563EB; /* Biru */
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            margin-top: auto; /* Push ke bawah */
            transition: background 0.2s;
            width: 100%; border: none; cursor: pointer;
        }
        .ssl-btn:hover { background-color: #1d4ed8; /* Biru lebih gelap */ }

        /* 2. GENERAL PLAN CARD (Email/VPN) */
        .plan-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s;
            background: white;
            position: relative;
        }
        .plan-card:hover {
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
            border-color: #93c5fd; /* Blue-300 */
        }
        
        .discount-badge {
            position: absolute; top: -12px; right: 20px;
            background-color: #EFF6FF; /* Blue-50 */
            color: #2563EB; /* Blue-600 */
            border: 1px solid #BFDBFE;
            font-size: 11px; font-weight: bold; padding: 2px 10px; border-radius: 20px;
        }
        
        .best-value-badge {
            position: absolute; top: -12px; left: 50%; transform: translateX(-50%);
            background-color: #FACC15; color: #854D0E;
            font-size: 11px; font-weight: bold; padding: 2px 10px; border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        /* Tombol Aksi Utama */
        .btn-action {
            background-color: #2563EB; /* Biru */
            color: white;
            font-weight: bold;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            display: block;
            width: 100%;
            transition: all 0.2s;
            box-shadow: 0 2px 5px rgba(37, 99, 235, 0.2);
            border: none; cursor: pointer;
        }
        .btn-action:hover {
            background-color: #1d4ed8;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
        
        /* Toggle Switcher */
        .toggle-container { background: #F3F4F6; border-radius: 8px; padding: 4px; display: inline-flex; margin-bottom: 20px; }
        .toggle-btn { padding: 8px 20px; border-radius: 6px; font-size: 14px; font-weight: 600; color: #6B7280; transition: all 0.2s; }
        .toggle-btn.active { background: white; color: #2563EB; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    </style>
@endsection

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20">

        {{-- Breadcrumb --}}
        <div class="mb-6">
            <a href="{{ route('saas.detail') }}" class="text-sm text-gray-500 hover:text-blue-600 flex items-center gap-1">
                <i class="ri-arrow-left-line"></i> Kembali ke Marketplace
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI (Detail Konten Utama) --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Hero Image --}}
                <div class="bg-gray-100 rounded-2xl h-64 md:h-80 overflow-hidden shadow-sm border border-gray-200">
                    <img src="{{ Str::startsWith($app->img_hero, 'http') ? $app->img_hero : asset($app->img_hero) }}" alt="{{ $app->name }}" class="hero-img">
                </div>

                {{-- Header Info --}}
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $app->name }}</h1>
                    <p class="text-gray-600 text-lg">{{ $app->short_desc }}</p>
                    
                    {{-- Stats --}}
                    <div class="flex items-center gap-4 mt-4 text-sm text-gray-500">
                        <div class="flex items-center gap-1">
                            <i class="ri-star-fill text-yellow-400 text-lg"></i>
                            <span class="font-bold text-gray-900">{{ $app->rating }}</span>
                            <span>({{ $app->reviews_count }} review)</span>
                        </div>
                        <div class="w-px h-4 bg-gray-300"></div>
                        <div><i class="ri-user-line mr-1"></i> {{ $app->subscribers }} pengguna</div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="prose max-w-none text-gray-600 border-t border-gray-200 pt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tentang Aplikasi</h3>
                    <p class="whitespace-pre-line">{{ $app->description }}</p>
                </div>

                {{-- ================================================= --}}
                {{-- KHUSUS SSL: GRID PRODUK (STYLE BARU: WHITE & BLUE) --}}
                {{-- ================================================= --}}
                @if($app->slug === 'ssl-certificates')
                    <div class="pt-8 border-t border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="ri-shield-check-fill text-blue-600"></i> Pilih Sertifikat SSL
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($app->plans as $plan)
                                <div class="ssl-card relative p-6">
                                    
                                    {{-- Badge Diskon --}}
                                    @if(isset($plan->discount_tag))
                                        <div class="ssl-badge">{{ $plan->discount_tag }}</div>
                                    @endif

                                    {{-- Konten Card --}}
                                    <div class="text-center mb-4 pt-2">
                                        <h4 class="text-lg font-bold text-gray-800 mb-1">{{ $plan->name }}</h4>
                                        @if(isset($plan->tag))
                                            <span class="text-[10px] bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full font-bold uppercase tracking-wider block w-max mx-auto mb-2">{{ $plan->tag }}</span>
                                        @endif
                                        
                                        <div class="my-3">
                                            <span class="ssl-price">Rp {{ number_format($plan->price_display / 1000, 0) }}rb</span>
                                            <span class="text-xs text-gray-500">/thn</span>
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-1">{{ $plan->renew_text ?? '' }}</p>
                                    </div>

                                    <div class="text-xs text-gray-600 space-y-2 mb-6 px-2 text-center">
                                        @foreach($plan->features as $feature)
                                            <p class="flex items-center justify-center gap-1">
                                                <i class="ri-check-line text-green-500"></i> {{ $feature }}
                                            </p>
                                        @endforeach
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="type" value="saas">
                                        <input type="hidden" name="product_name" value="{{ $app->name . ' - ' . $plan->name }}">
                                        <input type="hidden" name="price" value="{{ $plan->real_price }}">
                                        <input type="hidden" name="cycle" value="annually">
                                        
                                        <button type="submit" class="ssl-btn w-full">Beli Sekarang</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @else
                    {{-- UNTUK PRODUK LAIN: FITUR LIST BIASA --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Fitur Utama</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($app->features as $feature)
                                <div class="flex items-start gap-2">
                                    <i class="ri-checkbox-circle-fill text-blue-500 mt-1"></i>
                                    <span class="text-gray-700 text-sm">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{-- END SSL GRID --}}

                {{-- REVIEWS SECTION --}}
                <div class="pt-8 border-t border-gray-200" id="review-section">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Ulasan & Rating</h2>
                        <span class="text-sm text-gray-500">{{ $realReviews->count() }} Ulasan</span>
                    </div>

                    {{-- Form Input / Login Prompt --}}
                    @auth
                        <div class="bg-white p-6 rounded-xl border border-gray-200 mb-8 shadow-sm">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Berikan Ulasan Anda</h3>
                            <form action="{{ route('saas.review.store', $slug) }}" method="POST">
                                @csrf
                                <div class="flex gap-1 mb-4 text-2xl" id="star-rating-input">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="ri-star-line cursor-pointer text-gray-300 transition star-btn" data-value="{{ $i }}"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating-value" required>
                                </div>
                                <textarea name="comment" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none mb-3" rows="3" placeholder="Tulis ulasan Anda..." required></textarea>
                                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">Kirim Ulasan</button>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-8 text-center">
                            <p class="text-gray-600 font-medium mb-3">Ingin memberikan ulasan?</p>
                            <a href="{{ route('login') }}" class="inline-block bg-white text-blue-600 border border-blue-600 font-bold py-2 px-6 rounded-lg hover:bg-blue-50 transition shadow-sm">
                                Login Sekarang
                            </a>
                        </div>
                    @endauth

                    {{-- List Ulasan --}}
                    <div class="space-y-4">
                        @foreach ($realReviews as $review)
                            <div class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3">
                                        {{-- FOTO PROFIL --}}
                                        <img src="{{ $review->user->profile_photo_url }}" 
                                             alt="{{ $review->user->name }}" 
                                             class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $review->user->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-xs">
                                        @for($i=0; $i<$review->rating; $i++) <i class="ri-star-fill"></i> @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm mt-3">"{{ $review->comment }}"</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (SIDEBAR) --}}
            <div class="lg:col-span-1">
                <div class="sticky-sidebar space-y-6">
                    
                    {{-- JIKA SSL: TAMPILKAN INFO BANTUAN SAJA (Karena Harga Sudah Di Grid) --}}
                    @if($app->slug === 'ssl-certificates')
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="ri-customer-service-2-line text-blue-600 text-xl"></i> Bantuan SSL
                            </h4>
                            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                                Tim kami siap membantu Anda memilih dan menginstal sertifikat SSL yang tepat.
                            </p>
                            <ul class="space-y-3 text-sm text-gray-600 mb-6">
                                <li class="flex gap-2"><i class="ri-check-line text-green-500"></i> Instalasi Gratis</li>
                                <li class="flex gap-2"><i class="ri-check-line text-green-500"></i> Garansi Uang Kembali</li>
                            </ul>
                            <a href="{{ route('contact') }}" class="block text-center bg-white border border-blue-600 text-blue-600 py-3 rounded-lg font-bold hover:bg-blue-50 transition">
                                Hubungi Sales
                            </a>
                        </div>

                    {{-- JIKA BUKAN SSL (EMAIL/VPN): TAMPILKAN PRICING CARD --}}
                    @else
                        {{-- 1. FAST VPN (LAYOUT KHUSUS) --}}
                        @if($app->slug === 'fast-vpn')
                             <div class="space-y-4">
                                @foreach(['monthly', 'yearly', 'triennially'] as $key)
                                    @if(isset($app->plans->$key))
                                        @php $plan = $app->plans->$key; @endphp
                                        <div class="plan-card relative">
                                            @if(isset($plan->discount_tag)) <span class="discount-badge">{{ $plan->discount_tag }}</span> @endif
                                            @if(isset($plan->tag) && $plan->tag === 'PROMO') <span class="best-value-badge">PROMO</span> @endif
                                            
                                            <h3 class="font-bold text-gray-800 text-sm mb-2">{{ $plan->name }}</h3>
                                            @if(isset($plan->price_crossed)) <div class="text-xs text-gray-400 line-through font-medium">Rp {{ number_format($plan->price_crossed, 0, ',', '.') }}</div> @endif
                                            
                                            <div class="flex items-baseline gap-1 mb-1">
                                                <span class="text-3xl font-extrabold text-blue-800">Rp {{ number_format($plan->price_display, 0, ',', '.') }}</span>
                                                <span class="text-xs text-gray-500 font-medium">/mo</span>
                                            </div>

                                            <div class="text-[10px] text-gray-500 mb-4 min-h-[15px]">
                                                @if(isset($plan->total_text)) <span>{{ $plan->total_text }}</span> @endif
                                            </div>

                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="saas">
                                                <input type="hidden" name="product_name" value="{{ $app->name . ' - ' . $plan->name }}">
                                                <input type="hidden" name="price" value="{{ $plan->real_price }}">
                                                <input type="hidden" name="cycle" value="{{ $plan->cycle }}">
                                                <button type="submit" class="btn-action">{{ $plan->btn_text }}</button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        
                        {{-- 2. EMAIL & LAINNYA (TOGGLE) --}}
                        {{-- 2. EMAIL & LAINNYA (TOGGLE) --}}
                        @else
                            @php
                                $saasCycle = 'lifetime';
                                $saasDiscountType = 'percent';
                                $saasDiscountValue = 0;
                                
                                if (is_array($app->plans)) {
                                    $saasCycle = $app->plans['cycle'] ?? 'monthly_yearly';
                                    $saasDiscountType = $app->plans['annual_discount_type'] ?? 'percent';
                                    $saasDiscountValue = $app->plans['annual_discount_value'] ?? 0;
                                } elseif (is_object($app->plans)) {
                                    $saasCycle = $app->plans->cycle ?? 'monthly_yearly';
                                    $saasDiscountType = $app->plans->annual_discount_type ?? 'percent';
                                    $saasDiscountValue = $app->plans->annual_discount_value ?? 0;
                                }
                            @endphp
                            
                            <div x-data="{ billing: '{{ $saasCycle === 'monthly_yearly' ? 'monthly' : $saasCycle }}' }">
                                @if($saasCycle === 'monthly_yearly')
                                <div class="flex justify-center w-full mb-8">
                                    <div class="toggle-container bg-gray-100 p-1 rounded-lg inline-flex">
                                        <button @click="billing = 'monthly'" :class="billing === 'monthly' ? 'bg-white shadow text-blue-600' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2 text-sm font-bold rounded-md transition-all">Bulanan</button>
                                        <button @click="billing = 'annually'" :class="billing === 'annually' ? 'bg-white shadow text-blue-600' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2 text-sm font-bold rounded-md transition-all">Tahunan <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full ml-1">Hemat</span></button>
                                    </div>
                                </div>
                                @endif

                                <div class="space-y-4">
                                        @if(strtolower($app->category) == 'plugin')
                                            @php
                                                $pluginCycle = 'lifetime';
                                                $discountType = 'percent';
                                                $discountValue = 0;
                                                
                                                if (is_array($app->plans)) {
                                                    $pluginCycle = $app->plans['cycle'] ?? 'lifetime';
                                                    $discountType = $app->plans['annual_discount_type'] ?? 'percent';
                                                    $discountValue = $app->plans['annual_discount_value'] ?? 0;
                                                } elseif (is_object($app->plans)) {
                                                    $pluginCycle = $app->plans->cycle ?? 'lifetime';
                                                    $discountType = $app->plans->annual_discount_type ?? 'percent';
                                                    $discountValue = $app->plans->annual_discount_value ?? 0;
                                                }
                                                
                                                $monthlyPrice = $app->price;
                                                $yearlyBasePrice = $monthlyPrice * 12;
                                                $discountAmount = 0;
                                                
                                                if ($discountType === 'percent') {
                                                    $discountAmount = $yearlyBasePrice * ($discountValue / 100);
                                                } else {
                                                    $discountAmount = $discountValue;
                                                }
                                                
                                                $yearlyFinalPrice = max(0, $yearlyBasePrice - $discountAmount);
                                            @endphp
                                            
                                            <div class="border-2 border-blue-500 rounded-2xl p-6 relative bg-white shadow-xl" x-data="{ pluginBilling: '{{ $pluginCycle === 'monthly_yearly' ? 'monthly' : $pluginCycle }}' }">
                                                <div class="absolute -top-3 inset-x-0 flex justify-center">
                                                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">LISENSI PLUGIN</span>
                                                </div>
                                                <h3 class="font-bold text-gray-800 text-lg text-center mt-2">{{ $app->name }}</h3>
                                                
                                                @if($pluginCycle === 'monthly_yearly')
                                                    <div class="flex justify-center mt-4">
                                                        <div class="bg-gray-100 p-1 rounded-lg inline-flex">
                                                            <button type="button" @click="pluginBilling = 'monthly'" :class="pluginBilling === 'monthly' ? 'bg-white shadow text-blue-600' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 text-sm font-bold rounded-md transition-all">Bulanan</button>
                                                            <button type="button" @click="pluginBilling = 'annually'" :class="pluginBilling === 'annually' ? 'bg-white shadow text-blue-600' : 'text-gray-500 hover:text-gray-700'" class="px-4 py-1.5 text-sm font-bold rounded-md transition-all">Tahunan <span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded-full ml-1">Hemat</span></button>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="mt-4 mb-6 text-center">
                                                    {{-- Bulanan --}}
                                                    <div x-show="pluginBilling === 'monthly'">
                                                        <div class="flex items-baseline justify-center gap-1">
                                                            <span class="text-4xl font-extrabold text-blue-800">Rp {{ number_format($monthlyPrice, 0, ',', '.') }}</span>
                                                            <span class="text-sm text-gray-500">/bln</span>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Tahunan --}}
                                                    <div x-show="pluginBilling === 'annually'" style="display: none;">
                                                        @if($pluginCycle === 'monthly_yearly' && $discountAmount > 0)
                                                            <div class="text-xs text-gray-400 line-through mb-1">Rp {{ number_format($yearlyBasePrice, 0, ',', '.') }}</div>
                                                        @endif
                                                        <div class="flex items-baseline justify-center gap-1">
                                                            <span class="text-4xl font-extrabold text-blue-800">Rp {{ number_format($yearlyFinalPrice, 0, ',', '.') }}</span>
                                                            <span class="text-sm text-gray-500">/thn</span>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Lifetime --}}
                                                    <div x-show="pluginBilling === 'lifetime'" style="display: none;">
                                                        <div class="flex items-baseline justify-center gap-1">
                                                            <span class="text-4xl font-extrabold text-blue-800">Rp {{ number_format($monthlyPrice, 0, ',', '.') }}</span>
                                                            <span class="text-sm text-gray-500"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <form action="{{ route('cart.add') }}" method="POST" class="mb-3 w-full">
                                                    @csrf
                                                    <input type="hidden" name="type" value="saas">
                                                    <input type="hidden" name="product_name" value="{{ $app->name }}">
                                                    
                                                    {{-- Hidden inputs bound to Alpine logic --}}
                                                    <input type="hidden" name="price" :value="pluginBilling === 'annually' ? {{ $yearlyFinalPrice }} : {{ $monthlyPrice }}">
                                                    <input type="hidden" name="cycle" :value="pluginBilling">
                                                    
                                                    <input type="hidden" name="domain_mode" value="skip">
                                                    <button type="submit" class="btn-action w-full py-3 text-lg">Beli Sekarang</button>
                                                </form>
                                                
                                                <div class="text-sm text-gray-500 border-t border-gray-100 pt-4 mt-4 text-center font-medium">
                                                    <span x-show="pluginBilling === 'monthly'">Pembayaran per bulan, lisensi perlu diperbarui setiap bulan.</span>
                                                    <span x-show="pluginBilling === 'annually'" style="display: none;">Pembayaran per tahun, lisensi aktif selama 1 tahun penuh.</span>
                                                    <span x-show="pluginBilling === 'lifetime'" style="display: none;">Hanya bayar sekali, lisensi aktif selamanya (Lifetime).</span>
                                                </div>
                                            </div>
                                        @else
                                            @foreach(['ultimate', 'pro', 'starter'] as $planKey)
                                                @if(isset($app->plans->$planKey))
                                                    @php 
                                                        $plan = $app->plans->$planKey; 
                                                        $monthlyPrice = $plan->price ?? 0;
                                                        $yearlyBasePrice = $monthlyPrice * 12;
                                                        $discountAmount = 0;
                                                        if ($saasDiscountType === 'percent') {
                                                            $discountAmount = $yearlyBasePrice * ($saasDiscountValue / 100);
                                                        } else {
                                                            $discountAmount = $saasDiscountValue;
                                                        }
                                                        $yearlyFinalPrice = max(0, $yearlyBasePrice - $discountAmount);
                                                    @endphp
                                                    <div class="border-2 {{ $planKey === 'pro' ? 'border-blue-500' : 'border-gray-200' }} rounded-2xl p-6 relative bg-white {{ $planKey === 'pro' ? 'shadow-xl scale-[1.02]' : '' }} transition-transform">
                                                        @if($planKey === 'pro')<div class="absolute -top-3 inset-x-0 flex justify-center"><span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Paling Populer</span></div>@endif
                                                        
                                                        <template x-if="billing === 'annually' && {{ $discountAmount }} > 0">
                                                            <span class="discount-badge text-xs bg-red-100 text-red-600 px-2 py-1 rounded font-bold absolute right-4 top-4">Diskon Tahunan</span>
                                                        </template>
                                                        
                                                        @if(isset($plan->tag) && $plan->tag)<span class="best-value-badge">{{ $plan->tag }}</span>@endif
                                                        
                                                        <h3 class="font-bold text-gray-800 text-lg">{{ $plan->name }}</h3>
                                                        
                                                        <div class="mt-2 mb-4">
                                                            {{-- Monthly view --}}
                                                            <template x-if="billing === 'monthly'">
                                                                <div>
                                                                    <div class="flex items-baseline gap-1">
                                                                        <span class="text-3xl font-extrabold text-blue-800">Rp {{ number_format($monthlyPrice / 1000, 0) }}rb</span>
                                                                        <span class="text-sm text-gray-500">/bln</span>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                            {{-- Yearly view --}}
                                                            <template x-if="billing === 'annually'">
                                                                <div>
                                                                    @if($saasCycle === 'monthly_yearly' && $discountAmount > 0)
                                                                        <div class="text-xs text-gray-400 line-through">Rp {{ number_format($yearlyBasePrice / 1000, 0) }}rb</div>
                                                                    @endif
                                                                    <div class="flex items-baseline gap-1">
                                                                        <span class="text-3xl font-extrabold text-blue-800">Rp {{ number_format($yearlyFinalPrice / 1000, 0) }}rb</span>
                                                                        <span class="text-sm text-gray-500">/thn</span>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                            {{-- Lifetime view --}}
                                                            <template x-if="billing === 'lifetime'">
                                                                <div>
                                                                    <div class="flex items-baseline gap-1">
                                                                        <span class="text-3xl font-extrabold text-blue-800">Rp {{ number_format($monthlyPrice / 1000, 0) }}rb</span>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                        
                                                        <form action="{{ route('order.config.saas') }}" method="GET" class="w-full">
                                                            <input type="hidden" name="product_name" value="{{ $app->name . ' - ' . $plan->name }}">
                                                            <input type="hidden" name="price" :value="billing === 'annually' ? {{ $yearlyFinalPrice }} : {{ $monthlyPrice }}">
                                                            <input type="hidden" name="cycle" :value="billing">
                                                            <button type="submit" class="btn-action w-full mb-3">Pilih Paket</button>
                                                        </form>
                                                        
                                                        @if(isset($plan->features_raw))
                                                            @php $features = array_map('trim', explode(',', $plan->features_raw)); @endphp
                                                            <ul class="space-y-2 text-sm text-gray-600 border-t border-gray-100 pt-4">
                                                                @foreach($features as $feature)
                                                                    @if($feature)
                                                                    <li class="flex items-start gap-2"><i class="ri-check-line text-blue-500 mt-0.5"></i><span class="leading-tight">{{ $feature }}</span></li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @elseif(isset($plan->features) && is_iterable($plan->features))
                                                            <ul class="space-y-2 text-sm text-gray-600 border-t border-gray-100 pt-4">
                                                                @foreach($plan->features as $feature)
                                                                    <li class="flex items-start gap-2"><i class="ri-check-line text-blue-500 mt-0.5"></i><span class="leading-tight">{{ $feature }}</span></li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('.star-btn');
        const input = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const val = this.dataset.value;
                input.value = val;
                stars.forEach(s => {
                    s.classList.toggle('text-yellow-400', s.dataset.value <= val);
                    s.classList.toggle('text-gray-300', s.dataset.value > val);
                });
            });
        });
    });
</script>
@endsection