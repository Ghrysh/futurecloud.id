<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FutureCloudID - Comprehensive IT Solutions">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - FutureCloud.id</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        i {
            display: inline-block;
            visibility: visible;
            font-style: normal;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Global Scroll Reveal Animation */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @yield('styles')
</head>

<body class="antialiased bg-gray-50">

    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false, atTop: true, isHome: {{ request()->is('/') || request()->is('catalog') || request()->is('services') || request()->is('about-us') || request()->is('contact') || request()->is('faq') ? 'true' : 'false' }}, isDarkTheme: {{ request()->is('catalog') || request()->is('services') || request()->is('about-us') || request()->is('contact') || request()->is('faq') ? 'true' : 'false' }} }" 
         @scroll.window="atTop = (window.pageYOffset < 20)"
         :class="{ 
             'bg-transparent border-transparent': atTop && isHome, 
             'bg-white/50 backdrop-blur-xl backdrop-saturate-150 shadow-sm border-b border-gray-200/50': !atTop || !isHome 
         }"
         class="w-full fixed top-0 left-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                {{-- LOGO & MENU KIRI --}}
                <div class="flex items-center gap-8">
                    <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer"
                        onclick="window.location='{{ url('/') }}'">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                            <i class="ri-cloud-fill text-2xl"></i>
                        </div>
                        <h1 class="font-bold text-xl tracking-tight block" :class="(atTop && isDarkTheme) ? 'text-white' : 'text-gray-900'">FutureCloud<span
                                class="text-blue-600">.id</span></h1>
                    </div>

                    <ul class="hidden lg:flex items-center gap-6 text-sm font-medium" :class="(atTop && isDarkTheme) ? 'text-gray-300' : 'text-gray-600'">
                        <li><a href="{{ url('/') }}"
                                class="hover:text-blue-600 transition-colors {{ request()->is('/') ? 'text-blue-600' : '' }}">Beranda</a>
                        </li>
                        <li><a href="{{ url('/catalog') }}"
                                class="hover:text-blue-600 transition-colors {{ request()->is('catalog') ? 'text-blue-600' : '' }}">Katalog</a>
                        </li>
                        <li><a href="{{ url('/services') }}"
                                class="hover:text-blue-600 transition-colors {{ request()->is('services') ? 'text-blue-600' : '' }}">Layanan</a>
                        </li>
                        <li><a href="{{ url('about-us') }}"
                                class="hover:text-blue-600 transition-colors {{ request()->is('about-us') ? 'text-blue-600' : '' }}">Tentang Kami</a></li>
                        <li><a href="{{ url('/contact') }}"
                                class="hover:text-blue-600 transition-colors {{ request()->is('contact') ? 'text-blue-600' : '' }}">Kontak</a>
                        </li>
                        <li><a href="{{ url('/faq') }}"
                                class="hover:text-blue-600 transition-colors {{ request()->is('faq') ? 'text-blue-600' : '' }}">FAQ</a>
                        </li>
                        </li>
                    </ul>
                </div>

                {{-- ACTION BUTTONS (DESKTOP) --}}
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                        @if (Auth::user()->role === 'partner')
                            <a href="{{ route('partner.dashboard') }}"
                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-bold text-purple-600 bg-purple-50 border border-purple-100 rounded-lg hover:bg-purple-100 transition"
                                title="Dashboard Partner">
                                <i class="ri-store-2-line text-base"></i>
                            </a>
                        @elseif(Auth::user()->partner_status === 'pending')
                            <a href="{{ route('partner.pending') }}"
                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-bold text-yellow-700 bg-yellow-50 border border-yellow-100 rounded-lg hover:bg-yellow-100 transition cursor-help">
                                <i class="ri-time-line text-base"></i>
                            </a>
                        @elseif(Auth::user()->partner_status === 'rejected')
                            <a href="{{ route('partner.register') }}"
                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-bold text-red-600 bg-red-50 border border-red-100 rounded-lg hover:bg-red-100 transition">
                                <i class="ri-error-warning-line text-base"></i>
                            </a>
                        @else
                            <a href="{{ route('partner.register') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition shadow-sm">
                                <i class="ri-shake-hands-line text-base text-gray-400"></i>
                                <span>Jadi Partner</span>
                            </a>
                        @endif

                        <a href="{{ route('client.dashboard') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-md shadow-blue-200">
                            <i class="ri-dashboard-3-line text-base"></i>
                        </a>

                        {{-- [BARU] KERANJANG DESKTOP --}}
                        <a href="{{ route('cart.index') }}"
                            class="relative p-2 hover:text-blue-600 transition rounded-full hover:bg-gray-100/20 ml-1"
                            :class="(atTop && isDarkTheme) ? 'text-gray-200' : 'text-gray-500'">
                            <i class="ri-shopping-cart-2-line text-xl"></i>
                            @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-orange-500 text-[10px] text-white font-bold ring-2 ring-white">{{ $cartCount }}</span>
                            @endif
                        </a>

                        {{-- Notifikasi Desktop --}}
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = !open; if(open){ fetch('{{ route('notifications.read') }}', {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}); }"
                                class="relative p-2 hover:text-blue-600 transition rounded-full hover:bg-gray-100/20 focus:outline-none"
                                :class="(atTop && isDarkTheme) ? 'text-gray-200' : 'text-gray-500'">
                                <i class="ri-notification-3-line text-xl"></i>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span
                                        class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                                @endif
                            </button>

                            {{-- Dropdown Notif --}}
                            <div x-show="open" @click.outside="open = false" x-cloak x-transition
                                class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 max-h-96 overflow-y-auto">
                                <div
                                    class="px-4 py-2 border-b border-gray-50 flex justify-between items-center sticky top-0 bg-white z-10">
                                    <h3 class="font-bold text-gray-700 text-sm">Notifikasi</h3>
                                    <span class="text-xs text-gray-400">Terbaru</span>
                                </div>
                                @forelse(auth()->user()->notifications as $notif)
                                    <a href="{{ $notif->data['link'] ?? '#' }}"
                                        class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">
                                        <div class="flex gap-3">
                                            <div class="mt-1"><i
                                                    class="{{ $notif->data['icon'] ?? 'ri-notification-line' }} {{ $notif->data['color'] ?? 'text-blue-500' }} text-lg"></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-sm font-semibold text-gray-800 {{ $notif->read_at ? 'font-normal text-gray-600' : '' }}">
                                                    {{ $notif->data['title'] }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5 leading-snug">
                                                    {{ $notif->data['message'] }}</p>
                                                <p class="text-[10px] text-gray-400 mt-1">
                                                    {{ $notif->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-6 text-center text-gray-400 text-sm">Tidak ada notifikasi</div>
                                @endforelse
                                <div class="border-t border-gray-100 p-2 sticky bottom-0 bg-white">
                                    <a href="{{ route('notifications.index') }}"
                                        class="block text-center text-sm font-bold text-blue-600 hover:bg-blue-50 py-2 rounded-lg transition">Lihat
                                        Semua</a>
                                </div>
                            </div>
                        </div>

                        <div class="h-8 w-px bg-gray-200"></div>

                        {{-- Profile Desktop --}}
                        <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                            <button @click="open = ! open"
                                class="flex items-center gap-3 pl-2 pr-1 py-1 rounded-full hover:bg-gray-50 transition focus:outline-none border border-transparent hover:border-gray-200">
                                <img class="h-9 w-9 rounded-full object-cover border border-gray-200 shadow-sm bg-gray-100"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-sm font-semibold text-gray-700 max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                    <i class="ri-arrow-down-s-line text-gray-400 text-lg transition-transform duration-200"
                                        :class="{ 'rotate-180': open }"></i>
                                </div>
                            </button>
                            <div x-show="open" x-cloak x-transition
                                class="absolute right-0 z-50 mt-3 w-56 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 py-2 border border-gray-100 origin-top-right">
                                <a href="{{ route('home') }}"
                                    class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"><i
                                        class="ri-home-4-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Beranda</a>
                                <a href="{{ route('profile.edit') }}"
                                    class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"><i
                                        class="ri-user-settings-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Profil Saya</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('auth.google.switch') }}"
                                    class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"><i
                                        class="ri-user-shared-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Ganti Akun</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="group flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-medium"><i
                                            class="ri-logout-box-r-line mr-3 text-red-400 group-hover:text-red-600 text-lg"></i>
                                        Keluar</a>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Guest Desktop --}}
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}"
                                class="text-sm font-semibold hover:text-blue-600 transition"
                                :class="(atTop && isDarkTheme) ? 'text-gray-200' : 'text-gray-600'">Masuk</a>
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-md shadow-blue-200">Daftar</a>
                        </div>
                    @endauth
                </div>

                {{-- MOBILE HEADER (KANAN) --}}
                <div class="flex lg:hidden items-center gap-2">
                    @auth
                        {{-- [BARU] KERANJANG MOBILE --}}
                        <a href="{{ route('cart.index') }}"
                            class="relative p-2 text-gray-500 hover:text-blue-600 transition focus:outline-none">
                            <i class="ri-shopping-cart-2-line text-xl"></i>
                            @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="absolute top-2 right-2 w-2 h-2 bg-orange-500 rounded-full border border-white"></span>
                            @endif
                        </a>

                        {{-- Notification Mobile --}}
                        <div x-data="{ notifOpen: false }" class="relative">
                            <button
                                @click="notifOpen = !notifOpen; if(notifOpen){ fetch('{{ route('notifications.read') }}', {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}); }"
                                class="relative p-2 text-gray-500 hover:text-blue-600 transition focus:outline-none">
                                <i class="ri-notification-3-line text-xl"></i>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span
                                        class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                                @endif
                            </button>
                            <div x-show="notifOpen" @click.outside="notifOpen = false" x-cloak x-transition
                                class="fixed left-4 right-4 top-20 z-[60] bg-white rounded-xl shadow-xl border border-gray-100 py-2 max-h-[60vh] overflow-y-auto">
                                <div class="px-4 py-2 border-b border-gray-50 flex justify-between items-center">
                                    <h3 class="font-bold text-gray-700 text-sm">Notifikasi</h3>
                                    <span class="text-xs text-gray-400">Terbaru</span>
                                </div>
                                @forelse(auth()->user()->notifications as $notif)
                                    <a href="{{ $notif->data['link'] ?? '#' }}"
                                        class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">
                                        <div class="flex gap-3">
                                            <div class="mt-1"><i
                                                    class="{{ $notif->data['icon'] ?? 'ri-notification-line' }} {{ $notif->data['color'] ?? 'text-blue-500' }} text-lg"></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-sm font-semibold text-gray-800 {{ $notif->read_at ? 'font-normal text-gray-600' : '' }}">
                                                    {{ $notif->data['title'] }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5 leading-snug">
                                                    {{ $notif->data['message'] }}</p>
                                                <p class="text-[10px] text-gray-400 mt-1">
                                                    {{ $notif->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-6 text-center text-gray-400 text-sm">Tidak ada notifikasi</div>
                                @endforelse
                                <div class="border-t border-gray-100 p-2 sticky bottom-0 bg-white">
                                    <a href="{{ route('notifications.index') }}"
                                        class="block text-center text-sm font-bold text-blue-600 hover:bg-blue-50 py-2 rounded-lg transition">Lihat
                                        Semua</a>
                                </div>
                            </div>
                        </div>

                        {{-- Profile Avatar Mobile --}}
                        <div x-data="{ profileOpen: false }" class="relative">
                            <button @click="profileOpen = !profileOpen" class="p-1 focus:outline-none">
                                <img class="h-8 w-8 rounded-full object-cover border border-gray-200"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            <div x-show="profileOpen" @click.outside="profileOpen = false" x-cloak x-transition
                                class="fixed left-4 right-4 top-20 z-[60] bg-white rounded-xl shadow-xl border border-gray-100 py-2 max-h-[60vh] overflow-y-auto">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i
                                        class="ri-user-settings-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Edit Profil
                                </a>
                                <a href="{{ route('client.dashboard') }}"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i
                                        class="ri-dashboard-3-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Client Area
                                </a>
                                {{-- Menu Partner Mobile --}}
                                @if (Auth::user()->role === 'partner')
                                    <a href="{{ route('partner.dashboard') }}"
                                        class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                        <i
                                            class="ri-store-2-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                        Partner Dashboard
                                    </a>
                                @elseif(Auth::user()->partner_status === 'pending')
                                    <a href="{{ route('partner.pending') }}"
                                        class="group flex items-center px-4 py-3 text-sm text-yellow-700 hover:bg-yellow-50 hover:text-yellow-800 transition">
                                        <i
                                            class="ri-time-line mr-3 text-yellow-500 group-hover:text-yellow-700 text-lg"></i>
                                        Menunggu Verifikasi
                                    </a>
                                @elseif(Auth::user()->partner_status === 'rejected')
                                    <a href="{{ route('partner.register') }}"
                                        class="group flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                                        <i
                                            class="ri-error-warning-line mr-3 text-red-400 group-hover:text-red-600 text-lg"></i>
                                        Daftar Ulang Partner
                                    </a>
                                @else
                                    <a href="{{ route('partner.register') }}"
                                        class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                        <i
                                            class="ri-shake-hands-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                        Jadi Partner
                                    </a>
                                @endif
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="group flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition font-medium">
                                        <i
                                            class="ri-logout-box-r-line mr-3 text-red-400 group-hover:text-red-600 text-lg"></i>
                                        Keluar
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Guest Mobile --}}
                        <div x-data="{ guestOpen: false }" class="relative">
                            <button @click="guestOpen = !guestOpen"
                                class="p-2 text-gray-600 hover:text-blue-600 focus:outline-none transition">
                                <div
                                    class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center border border-gray-200">
                                    <i class="ri-user-line text-lg"></i>
                                </div>
                            </button>
                            <div x-show="guestOpen" @click.outside="guestOpen = false" x-cloak x-transition
                                class="fixed left-4 right-4 top-20 z-[60] bg-white rounded-xl shadow-xl border border-gray-100 py-2 max-h-[60vh] overflow-y-auto">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                    <p class="text-sm font-bold text-gray-900">Selamat Datang</p>
                                    <p class="text-xs text-gray-500">Silakan masuk atau daftar</p>
                                </div>
                                <a href="{{ route('login') }}"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i
                                        class="ri-login-circle-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Masuk
                                </a>
                                <a href="{{ route('register') }}"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i class="ri-user-add-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Daftar Akun
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('partner.register') }}"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <i
                                        class="ri-shake-hands-line mr-3 text-gray-400 group-hover:text-blue-600 text-lg"></i>
                                    Jadi Partner
                                </a>
                            </div>
                        </div>
                    @endauth

                    {{-- Hamburger Menu --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 hover:text-blue-600 focus:outline-none ml-1"
                        :class="(atTop && isDarkTheme && !mobileMenuOpen) ? 'text-gray-200' : 'text-gray-600'">
                        <i class="text-2xl" :class="mobileMenuOpen ? 'ri-close-line' : 'ri-menu-4-line'"></i>
                    </button>
                </div>

            </div>
        </div>

        {{-- DRAWER MENU MOBILE --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition
            class="lg:hidden bg-white/70 backdrop-blur-xl backdrop-saturate-150 border-t border-gray-200/50 w-full absolute top-20 left-0 shadow-lg h-[calc(100vh-80px)] overflow-y-auto z-40">
            <div class="px-4 pt-4 pb-6 space-y-1">
                <a href="{{ url('/') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">Beranda</a>
                <a href="{{ url('/catalog') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium {{ request()->is('catalog') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">Katalog</a>
                <a href="{{ url('/services') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium {{ request()->is('services') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">Layanan</a>
                <a href="{{ url('/#why-choose-us') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Solusi</a>
                <a href="{{ url('about-us') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium {{ request()->is('about-us') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">Tentang Kami</a>
                <a href="{{ url('/contact') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Kontak</a>
                <a href="{{ url('/faq') }}"
                    class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">FAQ</a>
            </div>
        </div>
    </nav>

    <div class="{{ request()->is('/') || request()->is('catalog') || request()->is('services') || request()->is('about-us') || request()->is('contact') || request()->is('faq') ? '' : 'pt-20' }}">
        @yield('content')
    </div>

    {{-- FOOTER (Tidak Diubah) --}}
    <footer class="bg-gray-900 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <div class="col-span-2 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="ri-cloud-line text-xl text-blue-400"></i>
                        <p class="text-xl font-bold text-white">FutureCloud.id</p>
                    </div>
                    <p class="font-semibold text-sm text-white mt-2">PT Berkah Teknologi Terdepan</p>
                    <address class="text-gray-400 text-sm not-italic mt-3 leading-relaxed">
                        Gedung Jaya Lomba 5 unit A.6<br>
                        JL. M H Thamrin No.12, RT.002/RW.001<br>
                        Kb. Sirih, Kec. Menteng<br>
                        Jakarta Pusat 10340
                    </address>
                    <p class="flex items-center space-x-2 text-white text-sm mt-4">
                        <span class="text-pink-500"><i class="ri-phone-fill"></i></span>
                        <span>Phone: (+62) 815-2022-225</span>
                    </p>
                    <p class="flex items-center space-x-2 text-white text-sm mt-2">
                        <span class="text-pink-500"><i class="ri-mail-line"></i></span>
                        <span>Email: <a href="mailto:info@futurecloud.id"
                                class="hover:underline text-gray-400 hover:text-white transition">info@futurecloud.id</a></span>
                    </p>
                    <div class="flex space-x-3 mt-6">
                        <a href="https://www.instagram.com/futurecloud.id/"
                            class="w-8 h-8 flex items-center justify-center border border-gray-700 rounded-full text-gray-400 hover:text-blue-400 hover:border-blue-400 transition"><i
                                class="ri-instagram-fill"></i></a>
                    </div>
                </div>
                <div class="md:col-span-1">
                    <h4 class="font-bold text-white mb-4">Perusahaan</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ url('about-us') }}" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                        <li><a href="{{ url('contact') }}" class="hover:text-blue-400 transition">Kontak</a></li>
                    </ul>
                </div>
                <div class="md:col-span-1">
                    <h4 class="font-bold text-white mb-4">Layanan</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ url('/services') }}" class="hover:text-blue-400 transition">Layanan Cloud</a></li>
                        <li><a href="{{ url('/services') }}" class="hover:text-blue-400 transition">Pengembangan Kustom</a></li>
                        <li><a href="{{ url('/services') }}" class="hover:text-blue-400 transition">Konsultasi TI</a></li>
                    </ul>
                </div>
                <div class="md:col-span-1">
                    <h4 class="font-bold text-white mb-4">Sumber Daya</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ url('/portfolio') }}" class="hover:text-blue-400 transition">Dokumentasi</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-blue-400 transition">Pusat Bantuan</a></li>
                        <li><a href="{{ url('/faq') }}" class="hover:text-blue-400 transition">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="border-t border-gray-800 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>© 2025 FutureCloud.id. Hak cipta dilindungi undang-undang.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ url('/refund-policy') }}" class="hover:text-blue-400 transition">Kebijakan Pengembalian</a>
                    <a href="{{ url('/terms') }}" class="hover:text-blue-400 transition">Syarat Layanan</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')

    {{-- PANGGIL CHATBOT --}}
    <x-chatbot />

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/sys-ping/v1?path=' + encodeURIComponent(window.location.pathname), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).catch(err => console.error('Tracking failed'));
    });
    </script>

    @include('components.chatbot')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.customAlert = function(message, type = 'info') {
            Swal.fire({
                title: type === 'error' ? 'Oops...' : (type === 'success' ? 'Berhasil' : 'Info'),
                text: message,
                icon: type,
                confirmButtonColor: '#2563eb'
            });
        };

        window.confirmSubmit = function(event, message) {
            event.preventDefault();
            const form = event.target.closest('form') || event.target;
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        };
        
        window.confirmClickLink = function(event, message) {
            event.preventDefault();
            const link = event.currentTarget.href;
            if(!link || link.includes('javascript:')) return;
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        };

        // SCROLL REVEAL OBSERVER
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: "0px 0px -50px 0px"
            });

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });
        });
    </script>


</body>

</html>
