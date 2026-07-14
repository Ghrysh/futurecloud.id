<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin FutureCloud</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    {{-- Assets --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Scrollbar untuk Sidebar Admin (Dark Theme) */
        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #0f172a;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #334155;
            border-radius: 4px;
        }

        .sidebar-scroll:hover::-webkit-scrollbar-thumb {
            background-color: #475569;
        }
    </style>
</head>

<body class="antialiased text-gray-600">

    {{-- WRAPPER UTAMA DENGAN STATE ALPINE --}}
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden bg-gray-100">

        {{-- 1. MOBILE OVERLAY (Layar Gelap saat menu buka di HP) --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/50 z-20 md:hidden backdrop-blur-sm" x-cloak>
        </div>

        <!-- 2. SIDEBAR ADMIN -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col h-full shadow-2xl md:shadow-none">

            <!-- Logo Header -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800 shrink-0">
                <div class="flex items-center gap-2">
                    <i class="ri-shield-keyhole-fill text-2xl text-blue-500"></i>
                    <span class="font-bold text-lg tracking-wide">Admin Panel</span>
                </div>

                {{-- Tombol Close (Hanya muncul di Mobile) --}}
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <!-- Menu Scrollable -->
            <nav class="flex-1 overflow-y-auto sidebar-scroll py-4 px-3 space-y-1">

                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-2">Main</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-dashboard-line text-xl mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="{{ route('admin.monitoring') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group mt-1 {{ request()->routeIs('admin.monitoring') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i class="ri-line-chart-line text-xl mr-3 {{ request()->routeIs('admin.monitoring') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Monitoring</span>
                </a>

                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Transaksi</p>

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-file-list-3-line text-xl mr-3 {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola Pesanan</span>
                </a>

                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Produk & Layanan</p>

                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-shopping-bag-3-line text-xl mr-3 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola Produk</span>
                </a>

                <a href="{{ route('admin.saas.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.saas.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-apps-line text-xl mr-3 {{ request()->routeIs('admin.saas.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola SaaS App</span>
                </a>

                <a href="{{ route('admin.plugin.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.plugin.index', 'admin.plugin.create', 'admin.plugin.edit') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-plug-line text-xl mr-3 {{ request()->routeIs('admin.plugin.index', 'admin.plugin.create', 'admin.plugin.edit') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola Plugin</span>
                </a>

                <a href="{{ route('admin.plugin.customers') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.plugin.customers') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-group-line text-xl mr-3 {{ request()->routeIs('admin.plugin.customers') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Plugin Customer</span>
                </a>

                <a href="{{ route('admin.portfolios.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.portfolios.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-briefcase-4-line text-xl mr-3 {{ request()->routeIs('admin.portfolios.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola Portfolio</span>
                </a>

                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Pengguna & Partner</p>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-user-settings-line text-xl mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola User</span>
                </a>

                <a href="{{ route('admin.admins.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.admins.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-user-star-line text-xl mr-3 {{ request()->routeIs('admin.admins.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Kelola Admin</span>
                </a>

                <a href="{{ route('admin.partners.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.partners.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-shake-hands-line text-xl mr-3 {{ request()->routeIs('admin.partners.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Request Partner</span>
                </a>

                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Tampilan Depan</p>

                <a href="{{ route('admin.hero.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.hero.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <i
                        class="ri-image-edit-line text-xl mr-3 {{ request()->routeIs('admin.hero.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                    <span class="font-medium text-sm">Hero Section</span>
                </a>

                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Chatbot & Live Chat</p>

                <a href="{{ route('admin.chatbot.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.chatbot.index') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="ri-robot-2-line text-xl mr-3"></i>
                    <span class="font-medium text-sm">Latih Otak Bot</span>
                </a>

                <a href="{{ route('admin.chatbot.history') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.chatbot.history') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="ri-chat-history-line text-xl mr-3"></i>
                    <span class="font-medium text-sm">Inbox Follow Up</span>
                </a>

                <a href="{{ route('admin.chatbot.live') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.chatbot.live') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    <i class="ri-live-line text-xl mr-3"></i>
                    <span class="font-medium text-sm">Live Chat</span>
                </a>
            </nav>

            <!-- Logout Section -->
            <div class="p-4 border-t border-slate-800 bg-slate-900 shrink-0">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-3 py-2 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-slate-800 rounded-lg transition">
                        <i class="ri-logout-box-line mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden">

            <!-- Navbar Atas -->
            <header
                class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 shadow-sm z-10 shrink-0">

                <div class="flex items-center gap-3">
                    {{-- TOMBOL HAMBURGER (Mobile Only) --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none p-1 rounded-md">
                        <i class="ri-menu-2-line text-2xl"></i>
                    </button>

                    <h2 class="font-bold text-lg sm:text-xl text-gray-800 truncate">
                        @yield('header_title', 'Dashboard')
                    </h2>
                </div>

                {{-- Admin Profile Info --}}
                <div class="flex items-center gap-3">
                    <div class="text-right mr-1 hidden sm:block">
                        <p class="text-sm font-bold text-gray-700">{{ Auth::guard('admin')->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold shadow-sm">
                        {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Content Scroll Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto scroll sidebar to active menu
            const activeSidebarItem = document.querySelector('aside nav a.bg-blue-600');
            if (activeSidebarItem) {
                activeSidebarItem.scrollIntoView({ behavior: 'auto', block: 'center' });
            }

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