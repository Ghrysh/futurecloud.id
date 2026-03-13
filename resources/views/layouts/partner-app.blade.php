<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Partner Center</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased text-gray-600" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- MOBILE OVERLAY BACKDROP -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 md:hidden"
             x-cloak>
        </div>

        <!-- SIDEBAR PARTNER (Warna Aksen Ungu) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 flex flex-col h-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto transform -translate-x-full md:transform-none">
            
            <!-- Logo Area -->
            <div class="h-16 flex items-center px-6 border-b border-gray-100 justify-between md:justify-start">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center text-white">
                        <i class="ri-store-2-fill"></i>
                    </div>
                    <div>
                        <span class="font-bold text-lg text-gray-900 block leading-none">Partner</span>
                        <span class="text-[10px] text-purple-600 font-bold tracking-widest uppercase">Center</span>
                    </div>
                </div>
                <!-- Tombol Close Sidebar (Mobile Only) -->
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-700">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <!-- Menu Items -->
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                
                <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-2">Overview</p>
                
                <a href="{{ route('partner.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('partner.dashboard') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-dashboard-line text-xl mr-3"></i>
                    Dashboard
                </a>

                <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-6">Aplikasi Saya</p>

                <a href="{{ route('partner.apps.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('partner.apps.index') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-apps-2-line text-xl mr-3"></i>
                    Kelola Aplikasi
                </a>
                
                <a href="{{ route('partner.saas.create') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('partner.saas.create') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-add-circle-line text-xl mr-3"></i>
                    Upload Baru
                </a>

                <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-6">Bisnis</p>

                <a href="#" class="flex items-center px-3 py-2.5 rounded-lg text-gray-400 hover:bg-gray-50 hover:text-gray-600 cursor-not-allowed" title="Segera Hadir">
                    <i class="ri-wallet-3-line text-xl mr-3"></i>
                    Penghasilan
                </a>
                <a href="{{ route('partner.company.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('partner.company.index') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                    <i class="ri-building-4-line text-xl mr-3"></i>
                    Profil Perusahaan
                </a>

            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-gray-100">
                <a href="{{ route('client.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                    <i class="ri-arrow-left-circle-line mr-2"></i> Ke Client Area
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            
            <!-- Navbar Atas -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-10">
                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Button (Hamburger) -->
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none p-1 rounded-md hover:bg-gray-100">
                        <i class="ri-menu-2-line text-2xl"></i>
                    </button>
                    <h2 class="font-bold text-xl text-gray-800">@yield('header_title', 'Partner Dashboard')</h2>
                </div>
                
                {{-- Dropdown User --}}
                <div x-data="{ open: false }" class="relative">
                    
                    {{-- Tombol Trigger --}}
                    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none pl-3 pr-1 py-1 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-gray-700">{{ Auth::user()->company_name ?? Auth::user()->name }}</p>
                            <p class="text-xs text-green-600 font-medium flex items-center justify-end gap-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span> Verified Partner
                            </p>
                        </div>
                        
                        <img src="{{ Auth::user()->profile_photo_url }}" class="w-10 h-10 rounded-full border border-gray-200 object-cover">
                        
                        <i class="ri-arrow-down-s-line text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}"></i>
                    </button>

                    {{-- Isi Dropdown --}}
                    <div x-show="open" @click.outside="open = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 origin-top-right">
                        
                        {{-- Info Mobile Only --}}
                        <div class="px-4 py-3 border-b border-gray-100 md:hidden">
                            <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        {{-- Menu Navigasi --}}
                        <a href="{{ route('client.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition group">
                            <i class="ri-dashboard-3-line mr-3 text-gray-400 group-hover:text-purple-600 text-lg"></i> Ke Client Area
                        </a>
                        
                        <a href="{{ route('home') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition group">
                            <i class="ri-home-4-line mr-3 text-gray-400 group-hover:text-purple-600 text-lg"></i> Ke Beranda
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>
                        
                        <a href="{{ route('auth.google.switch') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition group">
                            <i class="ri-user-shared-line mr-3 text-gray-400 group-hover:text-purple-600 text-lg"></i> Ganti Akun
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition font-medium">
                                <i class="ri-logout-box-r-line mr-3 text-red-400 group-hover:text-red-600 text-lg"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Scroll -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @yield('content')
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
</body>
</html>