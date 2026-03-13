@extends('layouts.client-app')

@section('title', $title)

@section('content')

<div class="space-y-6">

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
        <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
        <nav class="flex text-sm text-gray-500">
            <a href="{{ route('client.dashboard') }}" class="hover:text-blue-600 transition">Client Area</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 font-medium">{{ $title }}</span>
        </nav>
    </div>

    <!-- MAIN CARD CONTAINER -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- 1. TOOLBAR (Search & Filter) -->
        <!-- Form tidak perlu action, kita handle via JS -->
        <div class="p-5 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row justify-between items-center gap-4">
            
            {{-- Kiri: Show Entries --}}
            <div class="hidden md:flex items-center text-sm text-gray-600">
                <span class="mr-2">Tampilkan</span>
                <select id="filter-per-page" class="border border-gray-300 rounded-lg px-2 py-1.5 focus:ring-blue-500 focus:border-blue-500 outline-none text-xs bg-white cursor-pointer">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="ml-2">Entri</span>
            </div>

            {{-- Kanan: Search & Status Filter --}}
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                
                {{-- Dropdown Status --}}
                <select id="filter-status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-blue-500 focus:border-blue-500 outline-none w-full sm:w-40 cursor-pointer">
                    <option value="all">Semua Status</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="suspended">Suspended</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                {{-- Input Search + Loading Indicator --}}
                <div class="relative w-full sm:w-auto">
                    <input type="text" id="search-input" placeholder="Cari layanan / IP..." 
                           class="border border-gray-300 border-r-0 rounded-lg px-3 py-2 pl-4 pr-10 text-sm w-full sm:w-64 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    
                    {{-- Ikon Search (Default) --}}
                    <div id="icon-search" class="absolute right-3 top-2.5 text-gray-400">
                        <i class="ri-search-line"></i>
                    </div>

                    {{-- Ikon Loading (Hidden by default) --}}
                    <div id="icon-loading" class="absolute right-3 top-2.5 text-blue-600 hidden animate-spin">
                        <i class="ri-loader-4-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. CONTAINER DATA (Akan di-refresh oleh AJAX) -->
        <div id="services-container" class="min-h-[200px] relative">
            {{-- Load Partial View Pertama Kali --}}
            @include('dashboard.partials.services-list')
        </div>

    </div>
</div>

{{-- SCRIPT LIVE SEARCH --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const filterStatus = document.getElementById('filter-status');
        const filterPerPage = document.getElementById('filter-per-page');
        const container = document.getElementById('services-container');
        const iconSearch = document.getElementById('icon-search');
        const iconLoading = document.getElementById('icon-loading');

        let timeout = null; // Untuk debounce

        // Fungsi utama Fetch Data
        function fetchServices(url = null) {
            // Tampilkan Loading
            iconSearch.classList.add('hidden');
            iconLoading.classList.remove('hidden');
            container.classList.add('opacity-50');

            // Ambil value dari filter
            const search = searchInput.value;
            const status = filterStatus.value;
            const perPage = filterPerPage.value;

            // Tentukan URL (jika url null, pakai URL saat ini)
            let fetchUrl = url ? new URL(url) : new URL(window.location.href);
            
            // Set parameter query string
            fetchUrl.searchParams.set('search', search);
            fetchUrl.searchParams.set('status', status);
            fetchUrl.searchParams.set('per_page', perPage);

            // AJAX Request
            fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
                
                // Update URL di browser tanpa reload (agar kalau di-refresh tetap sama)
                window.history.pushState({}, '', fetchUrl);

                // Re-attach event listener untuk pagination yang baru di-load
                attachPaginationListeners();
            })
            .catch(error => console.error('Error:', error))
            .finally(() => {
                // Sembunyikan Loading
                iconSearch.classList.remove('hidden');
                iconLoading.classList.add('hidden');
                container.classList.remove('opacity-50');
            });
        }

        // Event Listener: Ketik di Search (dengan Debounce 500ms)
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchServices(); // Reset ke halaman 1 otomatis karena URL baru
            }, 500); // Tunggu 500ms setelah user berhenti mengetik
        });

        // Event Listener: Ganti Dropdown
        filterStatus.addEventListener('change', () => fetchServices());
        filterPerPage.addEventListener('change', () => fetchServices());

        // Event Listener: Klik Pagination (Agar tidak reload halaman)
        function attachPaginationListeners() {
            const paginationLinks = document.querySelectorAll('.ajax-pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Cegah reload standar
                    const url = this.href;
                    fetchServices(url); // Fetch halaman yang diklik
                });
            });
        }

        // Jalankan sekali saat load
        attachPaginationListeners();
    });
</script>

@endsection