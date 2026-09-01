<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Client Area FutureCloud</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6;
        }

        [x-cloak] { display: none !important; }

        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: transparent; border-radius: 4px; }
        .sidebar-scroll:hover::-webkit-scrollbar-thumb { background-color: #E5E7EB; }
    </style>
</head>

<body class="antialiased text-gray-600">

    <!-- Wrapper Utama -->
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden bg-gray-50">

        {{-- MOBILE OVERLAY --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/50 z-40 md:hidden backdrop-blur-sm" x-cloak>
        </div>

        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col h-full shadow-xl md:shadow-none">

            <div class="h-16 flex items-center px-6 border-b border-gray-100 bg-white shrink-0">
                <a href="{{ route('client.dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                        <i class="ri-cloud-fill text-lg"></i>
                    </div>
                    <span class="font-bold text-lg text-gray-900 tracking-tight">FutureCloud</span>
                </a>
                <button @click="sidebarOpen = false" class="md:hidden ml-auto text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto sidebar-scroll py-4 px-3 space-y-1">
                <a href="{{ route('client.dashboard') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg group transition-all duration-200 font-medium text-sm
                   {{ request()->routeIs('client.dashboard') ? 'bg-blue-50 text-blue-700 shadow-sm ring-1 ring-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ri-home-4-line text-lg mr-3 {{ request()->routeIs('client.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    Dashboard
                </a>

                <div class="pt-5 pb-2 px-3 flex justify-between items-center">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Layanan Anda</p>
                </div>

                @php
                    // Ambil data count dari Middleware (pastikan controller sudah update untuk count 'saas')
                    $counts = $sidebarCounts ?? [];
                    
                    // MENU DIPERBAHARUI: HANYA 4 KATEGORI UTAMA + ALL
                    $menuItems = [
                        [
                            'route' => 'client.products', 
                            'icon' => 'ri-apps-line', 
                            'label' => 'Semua Layanan', 
                            'count' => $counts['products'] ?? 0
                        ],
                        [
                            'route' => 'client.domain', 
                            'icon' => 'ri-globe-line', 
                            'label' => 'Domain', 
                            'count' => $counts['domain'] ?? 0
                        ],
                        [
                            'route' => 'client.hosting', 
                            'icon' => 'ri-hard-drive-2-line', 
                            'label' => 'cPanel Hosting', // Label diperjelas
                            'count' => $counts['hosting'] ?? 0
                        ],
                        [
                            'route' => 'client.vps', 
                            'icon' => 'ri-server-line', 
                            'label' => 'Cloud VPS', // Label diperjelas
                            'count' => $counts['vps'] ?? 0
                        ],
                        [
                            'route' => 'client.saas', // Pastikan route ini ada di web.php
                            'icon' => 'ri-cloud-windy-line', 
                            'label' => 'SaaS Apps', 
                            'count' => $counts['saas'] ?? 0
                        ],
                        [
                            'route' => 'client.plugin', 
                            'icon' => 'ri-plug-line', 
                            'label' => 'Plugin Saya', 
                            'count' => $counts['plugin'] ?? 0
                        ],
                    ];
                @endphp

                @foreach ($menuItems as $item)
                    @if($item['route'] === 'client.plugin')
                        <div x-data="{ open: {{ request()->routeIs('client.plugin*') ? 'true' : 'false' }} }">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg group transition-all duration-200 {{ request()->routeIs('client.plugin*') ? 'bg-blue-50 text-blue-700 shadow-sm ring-1 ring-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <div class="flex items-center">
                                    <i class="{{ $item['icon'] }} text-lg mr-3 {{ request()->routeIs('client.plugin*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                                    <span class="font-medium text-sm">Plugin Saya</span>
                                </div>
                                <div class="flex items-center">
                                    @if (isset($item['count']) && $item['count'] > 0)
                                        <span class="px-2 py-0.5 mr-2 rounded-md text-[10px] font-bold {{ request()->routeIs('client.plugin*') ? 'bg-white text-blue-600 shadow-sm' : 'bg-gray-100 text-gray-500 group-hover:bg-white group-hover:text-gray-700 group-hover:shadow-sm' }}">
                                            {{ $item['count'] }}
                                        </span>
                                    @endif
                                    <i class="ri-arrow-down-s-line transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                                </div>
                            </button>
                            
                            <div x-show="open" x-collapse class="pl-9 pr-3 mt-1 space-y-1">
                                <a href="{{ route('client.plugin') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('client.plugin') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                                    List Plugin
                                </a>
                                <a href="{{ route('client.plugin.manage') }}" class="block px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('client.plugin.manage') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                                    Kelola Plugin
                                </a>
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center justify-between px-3 py-2.5 rounded-lg group transition-all duration-200
                           {{ request()->routeIs($item['route']) ? 'bg-blue-50 text-blue-700 shadow-sm ring-1 ring-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <div class="flex items-center">
                                <i class="{{ $item['icon'] }} text-lg mr-3 {{ request()->routeIs($item['route']) ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                                <span class="font-medium text-sm">{{ $item['label'] }}</span>
                            </div>
                            @if (isset($item['count']) && $item['count'] > 0)
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold {{ request()->routeIs($item['route']) ? 'bg-white text-blue-600 shadow-sm' : 'bg-gray-100 text-gray-500 group-hover:bg-white group-hover:text-gray-700 group-hover:shadow-sm' }}">
                                    {{ $item['count'] }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endforeach

                <div class="pt-5 pb-2 px-3">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Billing & Support</p>
                </div>

                <a href="{{ route('client.invoices') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('client.invoices') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ri-bill-line text-lg mr-3 {{ request()->routeIs('client.invoices') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    <span class="font-medium text-sm">Invoices</span>
                </a>

                <a href="{{ route('client.tickets.index') }}" class="flex items-center px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('client.tickets.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ri-customer-service-2-line text-lg mr-3 {{ request()->routeIs('client.tickets.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    <span class="font-medium text-sm">Support Ticket</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100">
                <a href="{{ url('/') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors mb-2">
                    <i class="ri-global-line mr-3 text-lg"></i>
                    Kembali ke Web
                </a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"
                    class="flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <i class="ri-logout-box-r-line mr-3 text-lg"></i>
                    Logout
                </a>
                <form id="logout-form-sidebar" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden">

            <!-- TOP NAVBAR -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0 z-30 sticky top-0">

                <!-- Left: Toggler & Breadcrumb -->
                <div class="flex items-center gap-3 md:gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 hover:text-blue-600 focus:outline-none p-1">
                        <i class="ri-menu-2-fill text-2xl"></i>
                    </button>

                    <div class="hidden sm:flex items-center text-sm font-medium text-gray-500">
                        <span class="hover:text-gray-700 cursor-pointer">Client Area</span>
                        <i class="ri-arrow-right-s-line mx-2 text-gray-400"></i>
                        <span class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded text-xs font-semibold uppercase">
                            @yield('title', 'Dashboard')
                        </span>
                    </div>
                </div>

                <!-- Right: Actions & Profile -->
                <div class="flex items-center gap-2 sm:gap-4">
                    
                    {{-- Promo Button --}}
                    <!-- <button class="flex items-center justify-center w-9 h-9 sm:w-auto sm:h-auto sm:px-4 sm:py-2 border border-blue-200 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-50 transition" title="Promo">
                        <i class="ri-coupon-3-line sm:mr-2 text-lg sm:text-base"></i>
                        <span class="hidden sm:inline">Promo</span>
                    </button> -->

                    {{-- Order Button --}}
                    <button class="flex items-center justify-center w-9 h-9 sm:w-auto sm:h-auto sm:px-4 sm:py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 shadow-sm shadow-blue-200 transition" title="Pesan Layanan" onclick="window.location='{{ route('catalog') }}'">
                        <i class="ri-shopping-cart-line sm:mr-2 text-lg sm:text-base"></i>
                        <span class="hidden sm:inline">Order</span>
                    </button>

                    {{-- [BARU] CART ICON (Client Area) --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-500 hover:text-blue-600 transition rounded-full hover:bg-gray-100 ml-1">
                        <i class="ri-shopping-cart-2-line text-xl"></i>
                        @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-orange-500 text-[10px] text-white font-bold ring-2 ring-white">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <div class="h-6 w-px bg-gray-200 mx-1 hidden sm:block"></div>

                    {{-- NOTIFIKASI ICON --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open; if(open) { fetch('{{ route('notifications.read') }}', {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}}); }"
                            class="relative p-2 text-gray-500 hover:text-blue-600 transition rounded-full hover:bg-gray-100">
                            <i class="ri-notification-3-line text-xl"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                            @endif
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition
                            class="fixed left-4 right-4 top-20 z-50 bg-white rounded-xl shadow-xl border border-gray-100 py-2 max-h-[80vh] overflow-y-auto
                                   md:absolute md:left-auto md:right-0 md:top-full md:mt-3 md:w-80 md:max-h-96"
                            style="display: none;">
                            <div class="px-4 py-2 border-b border-gray-50 flex justify-between items-center bg-white sticky top-0 z-10">
                                <h3 class="font-bold text-gray-700 text-sm">Notifikasi</h3>
                                <span class="text-xs text-gray-400">Terbaru</span>
                            </div>
                            @forelse(auth()->user()->notifications as $notif)
                                <a href="{{ $notif->data['link'] ?? '#' }}" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">
                                    <div class="flex gap-3">
                                        <div class="mt-1"><i class="{{ $notif->data['icon'] ?? 'ri-notification-line' }} {{ $notif->data['color'] ?? 'text-blue-500' }} text-lg"></i></div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800 {{ $notif->read_at ? 'font-normal' : '' }}">{{ $notif->data['title'] }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5 leading-snug">{{ $notif->data['message'] }}</p>
                                            <p class="text-[10px] text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-6 text-center text-gray-400 text-sm">
                                    <i class="ri-notification-off-line text-2xl mb-1 block"></i>
                                    Tidak ada notifikasi
                                </div>
                            @endforelse
                            <div class="border-t border-gray-100 p-2 sticky bottom-0 bg-white">
                                <a href="{{ route('notifications.index') }}" class="block text-center text-sm font-bold text-blue-600 hover:bg-blue-50 py-2 rounded-lg transition">Lihat Semua</a>
                            </div>
                        </div>
                    </div>

                    <div class="h-8 w-px bg-gray-200 mx-1"></div>

                    {{-- Profile Dropdown --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 sm:gap-3 focus:outline-none pl-1 pr-1 py-1 rounded-full hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-semibold text-gray-700 leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wide">Customer</p>
                            </div>
                            <img class="h-9 w-9 rounded-full object-cover border border-gray-200 shadow-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            <i class="ri-arrow-down-s-line text-gray-400 hidden sm:block"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 origin-top-right"
                            style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-gray-100 md:hidden bg-gray-50/50">
                                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('client.profile') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="ri-user-settings-line mr-3 text-gray-400 group-hover:text-blue-600"></i> Edit Profile
                            </a>
                            <a href="{{ route('home') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="ri-home-4-line mr-3 text-gray-400 group-hover:text-blue-600"></i> Kembali ke Home
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('auth.google.switch') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <i class="ri-user-shared-line mr-3 text-gray-400 group-hover:text-blue-600"></i> Ganti Akun
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium transition">
                                    <i class="ri-logout-box-r-line mr-3 text-red-400"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F9FAFB] p-4 md:p-8 scroll-smooth relative z-0">
                @yield('header')
                @yield('content')
                <div class="mt-10 border-t border-gray-200 pt-6 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} FutureCloud.id. Client Area Panel v2.0
                </div>
            </main>

        </div>
    </div>

        {{-- PANGGIL CHATBOT --}}
    <x-chatbot />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/sys-ping/v1?path=' + encodeURIComponent(window.location.pathname), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).catch(err => console.error('Tracking failed'));
        });
    </script>

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
    </script>

</body>
</html>