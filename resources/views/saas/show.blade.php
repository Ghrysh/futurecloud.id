@extends('layouts.landing')

@section('title', $app->name)

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .sticky-sidebar { position: sticky; top: 6rem; }
        .hero-img { width: 100%; height: 100%; object-fit: cover; }
        [x-cloak] { display: none !important; }
        
        /* App Store Style Header */
        .app-header-bg {
            background: linear-gradient(to right, #0f172a, #1e293b);
            position: relative;
            overflow: hidden;
        }
        
        /* --- FUTURECLOUD CARD STYLE --- */
        .ssl-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .ssl-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.15);
            border-color: #2563EB;
        }
        .ssl-badge {
            background-color: #2563EB;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 4px 10px;
            position: absolute;
            top: 0; left: 0;
            border-bottom-right-radius: 12px;
            z-index: 10;
        }
        .ssl-price { font-size: 28px; font-weight: 800; color: #1e40af; }
        .ssl-btn {
            background-color: #2563EB;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            margin-top: auto;
            transition: background 0.2s;
            width: 100%; border: none; cursor: pointer;
        }
        .ssl-btn:hover { background-color: #1d4ed8; }

        .plan-card {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s;
            background: white;
            position: relative;
        }
        .plan-card:hover {
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.1);
            transform: translateY(-4px);
            border-color: #93c5fd;
        }
        
        .btn-action {
            background-color: #2563EB;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            display: block;
            width: 100%;
            transition: all 0.2s;
            border: none; cursor: pointer;
        }
        .btn-action:hover {
            background-color: #1d4ed8;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
    </style>
@endsection

@section('content')

    {{-- APP HEADER (Marketplace Style) --}}
    <section class="app-header-bg pt-28 pb-12 px-4 text-white">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ Str::startsWith($app->img_hero, 'http') ? $app->img_hero : asset($app->img_hero) }}" alt="Background" class="w-full h-full object-cover blur-md">
            <div class="absolute inset-0 bg-slate-900/80"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row gap-6 md:gap-8 items-start">
            {{-- Breadcrumb (Mobile Friendly) --}}
            <div class="w-full md:hidden mb-4">
                <a href="{{ route('saas.detail') }}" class="text-xs text-slate-300 hover:text-white flex items-center gap-1">
                    <i class="ri-arrow-left-line"></i> Kembali ke Marketplace
                </a>
            </div>

            {{-- App Icon Placeholder --}}
            <div class="w-32 h-32 md:w-40 md:h-40 shrink-0 bg-white rounded-2xl md:rounded-[2rem] shadow-2xl p-2 border border-white/20 flex items-center justify-center overflow-hidden">
                <div class="w-full h-full bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl md:rounded-3xl flex items-center justify-center text-blue-600 font-black text-5xl md:text-6xl">
                    @if(strtolower($app->category) == 'plugin')
                        <i class="ri-plug-line"></i>
                    @else
                        {{ substr($app->name, 0, 1) }}
                    @endif
                </div>
            </div>

            {{-- App Details Header --}}
            <div class="flex-1">
                <div class="hidden md:flex mb-6">
                    <a href="{{ route('saas.detail') }}" class="text-sm text-slate-400 hover:text-white flex items-center gap-1 transition-colors">
                        <i class="ri-arrow-left-line"></i> Kembali ke Marketplace
                    </a>
                </div>
                
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-2 text-white drop-shadow-md">{{ $app->name }}</h1>
                <p class="text-blue-300 text-lg md:text-xl font-medium mb-4">{{ $app->short_desc }}</p>
                
                <div class="flex flex-wrap items-center gap-4 text-sm font-medium">
                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white/10 rounded-full border border-white/20 backdrop-blur-sm">
                        <i class="ri-store-2-fill text-blue-400"></i>
                        <span>{{ $app->partner_name }}</span>
                        @if($app->partner_verified ?? false)
                            <i class="ri-verified-badge-fill text-blue-400" title="Verified Partner"></i>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white/10 rounded-full border border-white/20 backdrop-blur-sm">
                        <i class="ri-star-fill text-yellow-400"></i>
                        <span class="font-bold">{{ $app->rating }}</span>
                        <span class="text-slate-300">({{ $app->reviews_count }} Ulasan)</span>
                    </div>

                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white/10 rounded-full border border-white/20 backdrop-blur-sm">
                        <i class="ri-download-cloud-2-line text-green-400"></i>
                        <span>{{ $app->subscribers }} Terinstal</span>
                    </div>

                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white/10 rounded-full border border-white/20 backdrop-blur-sm">
                        <i class="ri-price-tag-3-line text-purple-400"></i>
                        <span class="uppercase">{{ $app->category }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- KOLOM KIRI (Deskripsi & Galeri) --}}
            <div class="lg:col-span-2 space-y-12">
                
                {{-- Hero/Screenshot Image --}}
                <div class="bg-slate-100 rounded-3xl h-64 md:h-[400px] overflow-hidden shadow-lg border border-slate-200">
                    <img src="{{ Str::startsWith($app->img_hero, 'http') ? $app->img_hero : asset($app->img_hero) }}" alt="{{ $app->name }} Screenshot" class="hero-img hover:scale-105 transition-transform duration-700">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 border-b border-slate-200 pb-2">Deskripsi Produk</h3>
                    <div class="prose max-w-none text-slate-600 leading-relaxed">
                        <p class="whitespace-pre-line">{{ $app->description }}</p>
                    </div>
                </div>

                {{-- Fitur Khusus --}}
                @if($app->slug !== 'ssl-certificates')
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-6 border-b border-slate-200 pb-2">Fitur Unggulan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($app->features as $feature)
                                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                        <i class="ri-check-line font-bold"></i>
                                    </div>
                                    <span class="text-slate-700 font-medium">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- SSL GRID SECTION --}}
                @if($app->slug === 'ssl-certificates')
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-6 border-b border-slate-200 pb-2">Pilih Sertifikat SSL</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($app->plans as $plan)
                                <div class="ssl-card relative p-8">
                                    @if(isset($plan->discount_tag))
                                        <div class="ssl-badge">{{ $plan->discount_tag }}</div>
                                    @endif
                                    <div class="text-center mb-6 pt-2">
                                        <h4 class="text-xl font-bold text-slate-800 mb-2">{{ $plan->name }}</h4>
                                        @if(isset($plan->tag))
                                            <span class="text-[10px] bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full font-bold uppercase tracking-wider block w-max mx-auto mb-4">{{ $plan->tag }}</span>
                                        @endif
                                        <div class="my-4">
                                            <span class="ssl-price">Rp {{ number_format($plan->price_display / 1000, 0) }}rb</span>
                                            <span class="text-sm text-slate-500 font-medium">/thn</span>
                                        </div>
                                    </div>
                                    <div class="text-sm text-slate-600 space-y-3 mb-8 px-4">
                                        @foreach($plan->features as $feature)
                                            <p class="flex items-center justify-center gap-2">
                                                <i class="ri-shield-check-fill text-blue-500"></i> {{ $feature }}
                                            </p>
                                        @endforeach
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="type" value="saas">
                                        <input type="hidden" name="product_name" value="{{ $app->name . ' - ' . $plan->name }}">
                                        <input type="hidden" name="price" value="{{ $plan->real_price }}">
                                        <input type="hidden" name="cycle" value="annually">
                                        <button type="submit" class="ssl-btn py-3 text-lg">Pilih Paket Ini</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- REVIEWS SECTION --}}
                <div id="review-section" class="scroll-mt-24">
                    <div class="flex justify-between items-center mb-6 border-b border-slate-200 pb-2">
                        <h2 class="text-2xl font-bold text-slate-900">Ulasan Pengguna</h2>
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-sm font-bold">{{ $realReviews->count() }} Ulasan</span>
                    </div>

                    @auth
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 mb-8 shadow-sm">
                            <h3 class="font-bold text-lg text-slate-900 mb-2">Bagaimana pengalaman Anda?</h3>
                            <form action="{{ route('saas.review.store', $slug) }}" method="POST">
                                @csrf
                                <div class="flex gap-2 mb-4 text-3xl" id="star-rating-input">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="ri-star-line cursor-pointer text-slate-300 transition star-btn hover:text-yellow-400" data-value="{{ $i }}"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating-value" required>
                                </div>
                                <textarea name="comment" class="w-full border border-slate-300 rounded-xl p-4 text-sm focus:ring-2 focus:ring-blue-500 outline-none mb-4 resize-none" rows="3" placeholder="Ceritakan pengalaman Anda menggunakan aplikasi ini..." required></textarea>
                                <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold hover:bg-blue-600 transition shadow-lg">Kirim Ulasan</button>
                            </form>
                        </div>
                    @else
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 mb-8 text-center">
                            <i class="ri-chat-smile-3-line text-4xl text-slate-400 mb-3"></i>
                            <p class="text-slate-600 font-medium mb-4">Anda harus masuk untuk dapat memberikan ulasan.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-white text-slate-900 border border-slate-300 font-bold py-2.5 px-8 rounded-xl hover:bg-slate-100 transition shadow-sm">
                                Masuk ke Akun
                            </a>
                        </div>
                    @endauth

                    <div class="space-y-4">
                        @forelse ($realReviews as $review)
                            <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-slate-100">
                                        <div>
                                            <p class="text-base font-bold text-slate-900">{{ $review->user->name }}</p>
                                            <p class="text-xs font-medium text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-sm">
                                        @for($i=0; $i<$review->rating; $i++) <i class="ri-star-fill"></i> @endfor
                                    </div>
                                </div>
                                <p class="text-slate-600 text-sm leading-relaxed">"{{ $review->comment }}"</p>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-slate-500">Belum ada ulasan untuk aplikasi ini. Jadilah yang pertama!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (PRICING SIDEBAR) --}}
            <div class="lg:col-span-1">
                <div class="sticky-sidebar space-y-6">
                    
                    {{-- INFO BANTUAN UNTUK SSL --}}
                    @if($app->slug === 'ssl-certificates')
                        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-8 text-white shadow-xl">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                                <i class="ri-shield-check-fill text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-xl mb-3">Butuh Bantuan?</h4>
                            <p class="text-blue-100 text-sm mb-6 leading-relaxed">
                                Tim ahli kami siap membantu Anda dari proses pemilihan hingga instalasi sertifikat SSL di server Anda.
                            </p>
                            <a href="{{ route('contact') }}" class="block text-center bg-white text-blue-700 py-3.5 rounded-xl font-bold hover:bg-blue-50 transition shadow-lg">
                                Hubungi Sales
                            </a>
                        </div>
                    @else
                        {{-- HARGA & PAKET (SELAIN SSL) --}}
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xl shadow-slate-200/50">
                            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <i class="ri-shopping-cart-2-line text-blue-600"></i> Beli Aplikasi
                            </h3>

                            @if($app->slug === 'fast-vpn')
                                <div class="space-y-4">
                                    @foreach(['monthly', 'yearly', 'triennially'] as $key)
                                        @if(isset($app->plans->$key))
                                            @php $plan = $app->plans->$key; @endphp
                                            <div class="plan-card relative">
                                                @if(isset($plan->discount_tag)) <span class="absolute top-3 right-3 text-[10px] font-bold bg-red-100 text-red-600 px-2 py-1 rounded">{{ $plan->discount_tag }}</span> @endif
                                                @if(isset($plan->tag) && $plan->tag === 'PROMO') <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-yellow-400 text-yellow-900 text-[10px] font-bold px-3 py-1 rounded-full">PILIHAN TERBAIK</span> @endif
                                                
                                                <h3 class="font-bold text-slate-800 text-base mb-1">{{ $plan->name }}</h3>
                                                @if(isset($plan->price_crossed)) <div class="text-xs text-slate-400 line-through font-medium">Rp {{ number_format($plan->price_crossed, 0, ',', '.') }}</div> @endif
                                                
                                                <div class="flex items-baseline gap-1 my-2">
                                                    <span class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($plan->price_display, 0, ',', '.') }}</span>
                                                    <span class="text-xs text-slate-500 font-medium">/mo</span>
                                                </div>

                                                <div class="text-xs text-slate-500 mb-5 font-medium bg-slate-50 p-2 rounded-lg text-center">
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
                            @else
                                {{-- EMAIL & LAINNYA & PLUGIN --}}
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
                                    <div class="bg-slate-100 p-1.5 rounded-xl flex w-full mb-6">
                                        <button @click="billing = 'monthly'" :class="billing === 'monthly' ? 'bg-white shadow-sm text-slate-900 font-bold' : 'text-slate-500 font-medium hover:text-slate-700'" class="flex-1 py-2 text-sm rounded-lg transition-all">Bulanan</button>
                                        <button @click="billing = 'annually'" :class="billing === 'annually' ? 'bg-white shadow-sm text-slate-900 font-bold' : 'text-slate-500 font-medium hover:text-slate-700'" class="flex-1 py-2 text-sm rounded-lg transition-all flex items-center justify-center gap-1">Tahunan <span class="text-[9px] bg-green-500 text-white px-1.5 py-0.5 rounded-full">Hemat</span></button>
                                    </div>
                                    @endif

                                    <div class="space-y-4">
                                        @if(strtolower($app->category) == 'plugin')
                                            @php
                                                $monthlyPrice = $app->price;
                                                $yearlyBasePrice = $monthlyPrice * 12;
                                                $discountAmount = ($saasDiscountType === 'percent') ? ($yearlyBasePrice * ($saasDiscountValue / 100)) : $saasDiscountValue;
                                                $yearlyFinalPrice = max(0, $yearlyBasePrice - $discountAmount);
                                            @endphp
                                            <div class="text-center">
                                                {{-- Monthly --}}
                                                <div x-show="billing === 'monthly'">
                                                    <div class="flex items-baseline justify-center gap-1">
                                                        <span class="text-4xl font-extrabold text-slate-900">Rp {{ number_format($monthlyPrice, 0, ',', '.') }}</span>
                                                        <span class="text-sm text-slate-500">/bln</span>
                                                    </div>
                                                </div>
                                                {{-- Yearly --}}
                                                <div x-show="billing === 'annually'" style="display: none;">
                                                    @if($saasCycle === 'monthly_yearly' && $discountAmount > 0)
                                                        <div class="text-sm text-slate-400 line-through mb-1">Rp {{ number_format($yearlyBasePrice, 0, ',', '.') }}</div>
                                                    @endif
                                                    <div class="flex items-baseline justify-center gap-1">
                                                        <span class="text-4xl font-extrabold text-slate-900">Rp {{ number_format($yearlyFinalPrice, 0, ',', '.') }}</span>
                                                        <span class="text-sm text-slate-500">/thn</span>
                                                    </div>
                                                </div>
                                                {{-- Lifetime --}}
                                                <div x-show="billing === 'lifetime'" style="display: none;">
                                                    <div class="flex items-baseline justify-center gap-1">
                                                        <span class="text-4xl font-extrabold text-slate-900">Rp {{ number_format($monthlyPrice, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                                
                                                <form action="{{ route('cart.add') }}" method="POST" class="mt-8">
                                                    @csrf
                                                    <input type="hidden" name="type" value="saas">
                                                    <input type="hidden" name="product_name" value="{{ $app->name }}">
                                                    <input type="hidden" name="price" :value="billing === 'annually' ? {{ $yearlyFinalPrice }} : {{ $monthlyPrice }}">
                                                    <input type="hidden" name="cycle" :value="billing">
                                                    <input type="hidden" name="domain_mode" value="skip">
                                                    
                                                    @if($isExternalUrlActive && $externalUrl)
                                                        <a href="{{ $externalUrl }}" class="btn-action py-3.5 text-lg">Dapatkan Plugin</a>
                                                    @else
                                                        <button type="submit" class="btn-action py-3.5 text-lg">Dapatkan Plugin</button>
                                                    @endif
                                                </form>
                                                
                                                <p class="text-xs text-slate-500 mt-4 text-center px-4">
                                                    Lisensi berlaku sesuai masa aktif yang dipilih.
                                                </p>
                                            </div>
                                        @else
                                            @foreach((array)$app->plans as $planKey => $plan)
                                                @if(!in_array($planKey, ['cycle', 'annual_discount_type', 'annual_discount_value', 'is_external_url_active', 'external_url']) && (is_array($plan) || is_object($plan)))
                                                    @php 
                                                        $plan = (object) $plan;
                                                        $monthlyPrice = $plan->price ?? 0;
                                                        $yearlyBasePrice = $monthlyPrice * 12;
                                                        $discountAmount = ($saasDiscountType === 'percent') ? ($yearlyBasePrice * ($saasDiscountValue / 100)) : $saasDiscountValue;
                                                        $yearlyFinalPrice = max(0, $yearlyBasePrice - $discountAmount);
                                                    @endphp
                                                    <div class="border {{ $loop->iteration == 2 ? 'border-blue-500 ring-1 ring-blue-500' : 'border-slate-200' }} rounded-xl p-5 bg-white relative">
                                                        @if($loop->iteration == 2)
                                                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">Populer</div>
                                                        @endif
                                                        
                                                        <h3 class="font-bold text-slate-900 text-base mb-3">{{ $plan->name }}</h3>
                                                        
                                                        <div class="mb-4">
                                                            <template x-if="billing === 'monthly'">
                                                                <div class="flex items-baseline gap-1">
                                                                    <span class="text-2xl font-extrabold text-slate-900">Rp {{ number_format($monthlyPrice / 1000, 0) }}rb</span>
                                                                    <span class="text-xs text-slate-500">/bln</span>
                                                                </div>
                                                            </template>
                                                            <template x-if="billing === 'annually'">
                                                                <div>
                                                                    @if($saasCycle === 'monthly_yearly' && $discountAmount > 0)
                                                                        <div class="text-xs text-slate-400 line-through mb-0.5">Rp {{ number_format($yearlyBasePrice / 1000, 0) }}rb</div>
                                                                    @endif
                                                                    <div class="flex items-baseline gap-1">
                                                                        <span class="text-2xl font-extrabold text-slate-900">Rp {{ number_format($yearlyFinalPrice / 1000, 0) }}rb</span>
                                                                        <span class="text-xs text-slate-500">/thn</span>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                            <template x-if="billing === 'lifetime'">
                                                                <div class="flex items-baseline gap-1">
                                                                    <span class="text-2xl font-extrabold text-slate-900">Rp {{ number_format($monthlyPrice / 1000, 0) }}rb</span>
                                                                </div>
                                                            </template>
                                                        </div>
                                                        
                                                        @if($isExternalUrlActive && $externalUrl)
                                                            <a href="{{ $externalUrl }}" class="btn-action w-full text-sm py-2.5 mb-4 block text-center">Berlangganan</a>
                                                        @else
                                                            <form action="{{ route('order.config.saas') }}" method="GET" class="w-full mb-4">
                                                                <input type="hidden" name="product_name" value="{{ $app->name . ' - ' . $plan->name }}">
                                                                <input type="hidden" name="price" :value="billing === 'annually' ? {{ $yearlyFinalPrice }} : {{ $monthlyPrice }}">
                                                                <input type="hidden" name="cycle" :value="billing">
                                                                <button type="submit" class="btn-action w-full text-sm py-2.5">Berlangganan</button>
                                                            </form>
                                                        @endif
                                                        
                                                        @if(isset($plan->features_raw) || isset($plan->features))
                                                            @php 
                                                                $features = isset($plan->features_raw) ? array_map('trim', explode(',', $plan->features_raw)) : $plan->features;
                                                            @endphp
                                                            <ul class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                                                                @foreach($features as $feature)
                                                                    @if($feature)
                                                                    <li class="flex items-start gap-1.5"><i class="ri-check-line text-blue-500 font-bold"></i><span>{{ $feature }}</span></li>
                                                                    @endif
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
                        </div>
                    @endif

                    {{-- Keamanan Terjamin Widget --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 flex items-center gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 shrink-0">
                            <i class="ri-shield-keyhole-line text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Transaksi Aman</h4>
                            <p class="text-xs text-slate-500">Dilindungi enkripsi SSL 256-bit dan garansi kepuasan 100%.</p>
                        </div>
                    </div>
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
                    s.classList.toggle('text-slate-300', s.dataset.value > val);
                });
            });
            
            // Hover effect for rating
            star.addEventListener('mouseover', function() {
                const val = this.dataset.value;
                stars.forEach(s => {
                    s.classList.toggle('text-yellow-400', s.dataset.value <= val);
                    s.classList.toggle('text-slate-300', s.dataset.value > val);
                });
            });
            
            star.parentElement.addEventListener('mouseout', function() {
                const val = input.value || 0;
                stars.forEach(s => {
                    s.classList.toggle('text-yellow-400', s.dataset.value <= val);
                    s.classList.toggle('text-slate-300', s.dataset.value > val);
                });
            });
        });
    });
</script>
@endsection
