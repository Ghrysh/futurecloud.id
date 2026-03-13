@extends('layouts.admin-app')

@section('title', 'Kelola Produk')
@section('header_title', 'Daftar Produk')

@section('content')
<div class="space-y-6" x-data="productManager()">

    {{-- HEADER & TABS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-2">
        <nav class="flex space-x-1">
            @php
                $tabs = [
                    'domain'  => ['icon' => 'ri-global-line', 'label' => 'Domain'],
                    'hosting' => ['icon' => 'ri-hard-drive-2-line', 'label' => 'Hosting'],
                    'vps'     => ['icon' => 'ri-server-line', 'label' => 'VPS'],
                ];
            @endphp

            @foreach($tabs as $key => $val)
                <button @click="changeTab('{{ $key }}')" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition flex-1 justify-center"
                   :class="activeTab === '{{ $key }}' ? 'bg-blue-50 text-blue-700 border border-blue-200 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'">
                    <i class="{{ $val['icon'] }} mr-2 text-lg"></i>
                    {{ $val['label'] }}
                </button>
            @endforeach
        </nav>
    </div>

    {{-- ACTION BAR (Search & Add) --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        
        {{-- Search Form (Realtime) --}}
        <div class="w-full md:w-96 relative">
            <i class="ri-search-line absolute left-3 top-2.5 text-gray-400"></i>
            <input type="text" x-model="searchQuery" @input.debounce.500ms="fetchData()"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                   placeholder="Cari produk...">
            
            {{-- Loading Icon --}}
            <div class="absolute right-3 top-2.5" x-show="isLoading">
                <i class="ri-loader-4-line animate-spin text-blue-600"></i>
            </div>
        </div>

        <a :href="'{{ route('admin.products.create') }}?type=' + activeTab" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 shadow-sm whitespace-nowrap">
            <i class="ri-add-line"></i> <span x-text="'Tambah ' + activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></span>
        </a>
    </div>

    {{-- TABLE CONTENT (AJAX TARGET) --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-h-[300px] relative">
        <div x-show="isLoading" class="absolute inset-0 bg-white/50 z-10 flex items-center justify-center"></div>
        
        <div id="product-table-content">
            {{-- Isi tabel dimuat via AJAX --}}
            @include('admin.products.partials.table', ['products' => $products, 'type' => $type])
        </div>
    </div>

</div>

<script>
    function productManager() {
        return {
            activeTab: '{{ $type }}',
            searchQuery: '',
            isLoading: false,

            init() {
                // Handle pagination click
                this.attachPaginationListeners();
            },

            changeTab(tab) {
                this.activeTab = tab;
                this.searchQuery = ''; // Reset search saat ganti tab
                this.fetchData();
            },

            fetchData(url = null) {
                this.isLoading = true;
                
                // Construct URL
                let fetchUrl = url || '{{ route('admin.products.index') }}';
                const urlObj = new URL(fetchUrl);
                urlObj.searchParams.set('type', this.activeTab);
                if (this.searchQuery) urlObj.searchParams.set('search', this.searchQuery);

                fetch(urlObj.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('product-table-content').innerHTML = html;
                    
                    // Update URL browser tanpa reload
                    window.history.pushState({}, '', urlObj.toString());
                    
                    this.attachPaginationListeners();
                })
                .finally(() => {
                    this.isLoading = false;
                });
            },

            attachPaginationListeners() {
                const links = document.querySelectorAll('#pagination-links a');
                links.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.fetchData(link.href);
                    });
                });
            }
        }
    }

    // Fungsi Delete Global
    function deleteProduct(id) {
        Swal.fire({
            title: 'Hapus Produk?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/products/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        Swal.fire('Terhapus!', data.message, 'success');
                        // Refresh data
                        document.querySelector('[x-data]').__x.$data.fetchData();
                    }
                });
            }
        })
    }
</script>
@endsection