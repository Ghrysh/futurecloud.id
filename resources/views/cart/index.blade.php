@extends('layouts.landing')

@section('title', 'Keranjang Belanja')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .custom-checkbox {
            accent-color: #2563eb;
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .custom-checkbox:hover {
            transform: scale(1.1);
        }
        @media (min-width: 1024px) {
            .sticky-summary {
                position: sticky;
                top: 6rem;
            }
        }
        .mobile-footer-shadow {
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.05), 0 -2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .cart-item {
            transition: all 0.3s ease;
        }
        .cart-item:hover {
            transform: translateY(-2px);
        }
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .icon-bounce {
            animation: bounce 1s ease-in-out infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
@endsection

@section('content')
<div class="pt-20 sm:pt-24 lg:pt-28 pb-32 lg:pb-24 bg-gradient-to-br from-gray-50 via-blue-50/30 to-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-6 sm:mb-8 lg:mb-10">
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-3 sm:mb-4">
                <a href="{{ url('/') }}" class="hover:text-blue-600 transition">
                    <i class="ri-home-4-line"></i>
                </a>
                <i class="ri-arrow-right-s-line text-gray-400"></i>
                <span class="text-gray-900 font-medium">Keranjang Belanja</span>
            </nav>
            
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 sm:gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                        Keranjang Belanja
                        @if(!$items->isEmpty())
                        <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 text-white rounded-full text-sm sm:text-base font-bold ml-2 sm:ml-3">
                            {{ $items->count() }}
                        </span>
                        @endif
                    </h1>
                    <p class="text-gray-500 text-sm sm:text-base">
                        <i class="ri-information-line"></i>
                        Periksa kembali pesanan Anda sebelum melanjutkan pembayaran
                    </p>
                </div>
                
                @if(!$items->isEmpty())
                <a href="{{ url('/catalog') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition shadow-sm text-sm sm:text-base">
                    <i class="ri-add-line"></i>
                    <span class="hidden sm:inline">Tambah Layanan</span>
                    <span class="sm:hidden">Tambah</span>
                </a>
                @endif
            </div>
        </div>

        @if($items->isEmpty())
            <!-- EMPTY STATE -->
            <div class="flex flex-col items-center justify-center py-16 sm:py-20 lg:py-24 bg-white rounded-2xl sm:rounded-3xl border-2 border-dashed border-gray-200 shadow-sm text-center">
                <div class="relative mb-6">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center">
                        <i class="ri-shopping-cart-line text-5xl sm:text-6xl text-blue-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center animate-pulse">
                        <span class="text-white text-xs font-bold">0</span>
                    </div>
                </div>
                
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Keranjang Masih Kosong</h3>
                <p class="text-gray-500 text-sm sm:text-base mt-2 mb-8 max-w-md px-4">
                    Yuk mulai belanja! Pilih layanan terbaik untuk kebutuhan bisnis digital Anda.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="{{ url('/catalog') }}" class="px-6 sm:px-8 py-3 sm:py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="ri-shopping-bag-line text-lg"></i>
                        Lihat Katalog
                    </a>
                </div>
            </div>
        @else
            <!-- CART FORM UTAMA -->
            <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                    
                    <!-- KOLOM KIRI: LIST ITEM -->
                    <div class="lg:col-span-2 space-y-4 sm:space-y-5">
                        
                        <!-- Select All Header -->
                        <div class="bg-white px-4 sm:px-5 py-3.5 sm:py-4 rounded-xl sm:rounded-2xl border-2 border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-3 cursor-pointer select-none group">
                                    <input type="checkbox" id="selectAll" class="custom-checkbox" checked onclick="toggleAll(this)">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm sm:text-base font-bold text-gray-700 group-hover:text-blue-600 transition">
                                            Pilih Semua
                                        </span>
                                        <span class="hidden sm:inline text-xs text-gray-400">
                                            ({{ $items->count() }} item)
                                        </span>
                                    </div>
                                </label>
                                <div class="flex items-center gap-2 sm:gap-3">
                                    <span class="text-xs sm:text-sm font-medium text-gray-500">
                                        {{ $items->count() }} Item Total
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Items Loop -->
                        @foreach($items as $index => $item)
                            
                            {{-- FIX PENTING: Pastikan config jadi array, apapun format di DB --}}
                            @php
                                $config = $item->configuration;
                                if (is_string($config)) {
                                    $config = json_decode($config, true);
                                }
                                if (!is_array($config)) {
                                    $config = [];
                                }
                            @endphp

                            <div class="cart-item bg-white p-4 sm:p-5 lg:p-6 rounded-2xl border-2 border-gray-200 shadow-sm hover:shadow-lg hover:border-blue-300 transition-all">
                                <div class="flex gap-3 sm:gap-4 items-start">
                                    
                                    <!-- Checkbox -->
                                    <div class="pt-1 sm:pt-1.5">
                                        <input type="checkbox" 
                                               name="selected_items[]" 
                                               value="{{ $item->id }}" 
                                               class="item-checkbox custom-checkbox" 
                                               data-price="{{ $item->price }}" 
                                               checked 
                                               onchange="calculateTotal()">
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Header dengan Icon & Price -->
                                        <div class="flex justify-between items-start mb-3 sm:mb-4 gap-3">
                                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                                <!-- Icon Badge -->
                                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl flex-shrink-0 flex items-center justify-center text-xl sm:text-2xl shadow-md transform hover:scale-110 transition
                                                    @if($item->type == 'domain') bg-gradient-to-br from-green-400 to-green-600 text-white
                                                    @elseif($item->type == 'vps') bg-gradient-to-br from-blue-400 to-blue-600 text-white
                                                    @elseif($item->type == 'hosting') bg-gradient-to-br from-orange-400 to-orange-600 text-white
                                                    @elseif($item->type == 'saas') bg-gradient-to-br from-purple-400 to-purple-600 text-white
                                                    @else bg-gradient-to-br from-gray-400 to-gray-600 text-white @endif">
                                                    
                                                    @if($item->type == 'domain') <i class="ri-global-line"></i>
                                                    @elseif($item->type == 'vps') <i class="ri-server-line"></i>
                                                    @elseif($item->type == 'hosting') <i class="ri-hard-drive-2-line"></i>
                                                    @elseif($item->type == 'saas') <i class="ri-apps-line"></i>
                                                    @else <i class="ri-price-tag-3-line"></i> @endif
                                                </div>

                                                <!-- Product Info -->
                                                <div class="min-w-0 flex-1">
                                                    <h3 class="font-bold text-gray-900 text-base sm:text-lg leading-tight mb-1">
                                                        {{ $item->product_name }}
                                                    </h3>
                                                    <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm">
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg font-medium capitalize">
                                                            <i class="ri-price-tag-3-line"></i>
                                                            {{ $item->type }}
                                                        </span>
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg font-medium capitalize">
                                                            <i class="ri-calendar-line"></i>
                                                            {{ $item->billing_cycle }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Price Desktop -->
                                            <div class="hidden sm:flex flex-col items-end">
                                                <div class="text-xs text-gray-400 mb-1">Harga</div>
                                                <p class="font-extrabold text-blue-600 text-lg lg:text-xl">
                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Price Mobile -->
                                        <div class="sm:hidden mb-3 pb-3 border-b border-gray-100">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-gray-500">Harga:</span>
                                                <div class="text-right">
                                                    <p class="font-extrabold text-blue-600 text-base">
                                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuration Details (FIXED LOGIC) -->
                                        @if(count($config) > 0)
                                            <div class="mt-4 bg-gradient-to-br from-gray-50 to-gray-100/50 rounded-xl p-3 sm:p-4 border border-gray-200">
                                                <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-200">
                                                    <i class="ri-settings-3-line text-gray-600"></i>
                                                    <span class="text-xs sm:text-sm font-bold text-gray-700">Konfigurasi</span>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 text-xs sm:text-sm">
                                                    @foreach($config as $key => $val)
                                                        @if(!empty($val))
                                                        <div class="flex items-start gap-2">
                                                            <i class="ri-checkbox-circle-fill text-blue-500 text-xs mt-0.5 flex-shrink-0"></i>
                                                            <div class="flex-1 min-w-0">
                                                                <span class="text-gray-500 capitalize block">{{ str_replace('_', ' ', $key) }}</span>
                                                                <span class="font-semibold text-gray-800 block truncate">{{ $val }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="mt-4 sm:mt-5 flex items-center justify-between sm:justify-end gap-2 sm:gap-3 pt-4 border-t-2 border-gray-100">
                                            <button type="button" 
                                                    onclick="triggerDelete('{{ route('cart.delete', $item->id) }}')" 
                                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-gradient-to-r from-red-50 to-red-100 text-red-700 rounded-xl text-xs sm:text-sm font-bold hover:from-red-100 hover:to-red-200 transition shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                                <i class="ri-delete-bin-line text-sm sm:text-base"></i> 
                                                <span>Hapus</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- KOLOM KANAN: RINGKASAN -->
                    <div class="lg:col-span-1">
                        <!-- Desktop Summary -->
                        <div class="hidden lg:block sticky-summary">
                            <div class="bg-white rounded-2xl shadow-xl border-2 border-gray-200 overflow-hidden">
                                <!-- Header dengan Gradient -->
                                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5">
                                    <h3 class="font-bold text-white text-lg flex items-center gap-2">
                                        <i class="ri-file-list-3-line"></i>
                                        Ringkasan Pesanan
                                    </h3>
                                </div>

                                <div class="p-6">
                                    <!-- Breakdown -->
                                    <div class="space-y-4 mb-6">
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-600 flex items-center gap-2">Subtotal</span>
                                            <span class="font-bold text-gray-900" id="subtotalLabelDesktop">Rp 0</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-600 flex items-center gap-2">PPN (11%)</span>
                                            <span class="font-bold text-gray-900" id="taxLabelDesktop">Rp 0</span>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t-2 border-dashed border-gray-200 my-6"></div>

                                    <!-- Total -->
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 mb-6">
                                        <div class="flex justify-between items-center">
                                            <span class="font-bold text-gray-700">Total Tagihan</span>
                                            <div class="text-right">
                                                <div class="font-extrabold text-2xl text-blue-600" id="totalLabel">Rp 0</div>
                                                <div class="text-xs text-gray-500 mt-0.5">Sudah termasuk pajak</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Checkout Button -->
                                    <button type="button" 
                                            onclick="submitCheckout()" 
                                            id="btnCheckout" 
                                            class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-bold shadow-lg hover:from-blue-700 hover:to-blue-800 transition transform hover:-translate-y-1 hover:shadow-xl flex justify-center items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span class="text-base">Lanjutkan Pembayaran</span>
                                        <i class="ri-arrow-right-line text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Summary (Fixed Bottom) -->
                        <div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t-2 border-gray-200 mobile-footer-shadow">
                            <div class="px-4 py-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 mb-1">Total Tagihan</span>
                                        <div class="flex items-baseline gap-2">
                                            <span class="font-extrabold text-xl sm:text-2xl text-blue-600 leading-none" id="totalLabel">Rp 0</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="submitCheckout()" id="btnCheckout" class="px-6 sm:px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-bold shadow-lg flex items-center gap-2 disabled:opacity-50">
                                        <span>Checkout</span>
                                        <i class="ri-arrow-right-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            {{-- FORM DELETE HIDDEN --}}
            <form id="deleteForm" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number);
    }

    function triggerDelete(url) {
        if(confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
            const form = document.getElementById('deleteForm');
            form.action = url;
            form.submit();
        }
    }

    function toggleAll(source) {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = source.checked;
        });
        calculateTotal();
    }

    function calculateTotal() {
        let subtotal = 0;
        let checkedCount = 0;
        const allCheckboxes = document.querySelectorAll('.item-checkbox');
        
        allCheckboxes.forEach(box => {
            if(box.checked) {
                subtotal += parseFloat(box.getAttribute('data-price'));
                checkedCount++;
            }
        });

        const selectAll = document.getElementById('selectAll');
        if(selectAll) selectAll.checked = (checkedCount === allCheckboxes.length && allCheckboxes.length > 0);

        let tax = subtotal * 0.11;
        let total = subtotal + tax;

        const subDesktop = document.getElementById('subtotalLabelDesktop');
        const taxDesktop = document.getElementById('taxLabelDesktop');
        
        if(subDesktop) subDesktop.innerText = formatRupiah(subtotal);
        if(taxDesktop) taxDesktop.innerText = formatRupiah(tax);

        const totalLabels = document.querySelectorAll('#totalLabel');
        totalLabels.forEach(el => el.innerText = formatRupiah(total));

        const btns = document.querySelectorAll('#btnCheckout');
        btns.forEach(btn => {
            if(checkedCount === 0) {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    }

    function submitCheckout() {
        const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
        if(checkedBoxes.length === 0) {
            alert('Harap pilih minimal satu item untuk melanjutkan.');
            return;
        }
        document.getElementById('checkoutForm').submit();
    }

    document.addEventListener('DOMContentLoaded', calculateTotal);
    document.querySelectorAll('.item-checkbox').forEach(box => {
        box.addEventListener('change', calculateTotal);
    });
</script>
@endsection