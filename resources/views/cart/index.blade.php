@extends('layouts.landing')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-slate-50 min-h-screen pt-28 pb-24 relative overflow-hidden font-['Inter']">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] bg-slate-200 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10 scroll-reveal">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Keranjang Anda</h1>
            <p class="text-slate-500 mt-3 font-medium">Tinjau kembali pesanan Anda sebelum melanjutkan ke pembayaran.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-200 shadow-sm flex items-center gap-3 font-medium">
                <i class="ri-checkbox-circle-fill text-xl"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-2xl border border-red-200 shadow-sm flex items-center gap-3 font-medium">
                <i class="ri-error-warning-fill text-xl"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($items->isEmpty())
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 p-12 text-center max-w-2xl mx-auto scroll-reveal">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="ri-shopping-cart-2-line text-4xl text-slate-400"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Keranjang Kosong</h2>
                <p class="text-slate-500 mb-8 font-medium">Anda belum menambahkan layanan apa pun ke dalam keranjang.</p>
                <a href="{{ route('home') }}" class="inline-flex px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-0.5">
                    Mulai Belanja <i class="ri-arrow-right-line ml-2"></i>
                </a>
            </div>
        @else
            <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- KOLOM KIRI: DAFTAR ITEM --}}
                    <div class="lg:col-span-2 space-y-4 scroll-reveal">
                        
                        {{-- Select All Header --}}
                        <div class="bg-white/80 backdrop-blur-xl px-6 py-4 rounded-2xl border border-slate-200 shadow-sm">
                            <label class="flex items-center gap-3 cursor-pointer group w-max">
                                <input type="checkbox" id="selectAll" class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500" checked onclick="toggleAll(this)">
                                <span class="font-bold text-slate-700 group-hover:text-blue-600 transition select-none">
                                    Pilih Semua ({{ $items->count() }} item)
                                </span>
                            </label>
                        </div>

                        {{-- Loop Items --}}
                        <div class="space-y-4">
                            @foreach($items as $item)
                                @php
                                    $config = json_decode($item->configuration, true) ?? [];
                                    
                                    // Tentukan Icon & Warna berdasarkan tipe
                                    $icon = 'ri-box-3-line';
                                    $color = 'text-slate-500';
                                    $bg = 'bg-slate-100';
                                    
                                    if($item->type == 'domain') { $icon = 'ri-global-line'; $color = 'text-blue-600'; $bg = 'bg-blue-50 border-blue-100'; }
                                    elseif($item->type == 'vps') { $icon = 'ri-server-line'; $color = 'text-indigo-600'; $bg = 'bg-indigo-50 border-indigo-100'; }
                                    elseif($item->type == 'hosting') { $icon = 'ri-cloud-line'; $color = 'text-orange-600'; $bg = 'bg-orange-50 border-orange-100'; }
                                    elseif($item->type == 'saas') { $icon = 'ri-rocket-line'; $color = 'text-emerald-600'; $bg = 'bg-emerald-50 border-emerald-100'; }
                                @endphp

                                <div class="bg-white/90 backdrop-blur-xl p-6 rounded-3xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center gap-5 hover:border-blue-300 transition-colors">
                                    
                                    <div class="flex items-center gap-4">
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" 
                                            class="item-checkbox w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 shrink-0" 
                                            data-price="{{ $item->price }}" checked>
                                        
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center border {{ $bg }} {{ $color }} shrink-0">
                                            <i class="{{ $icon }} text-2xl"></i>
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                            <div>
                                                <h3 class="font-bold text-slate-900 text-lg truncate">{{ $item->product_name }}</h3>
                                                <div class="flex flex-wrap items-center gap-2 mt-1">
                                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-xs font-bold rounded uppercase tracking-wider">{{ $item->type }}</span>
                                                    <span class="text-xs text-slate-500 font-medium">&bull; {{ str_replace(' Year(s)', ' Tahun', $item->billing_cycle) }}</span>
                                                </div>
                                                
                                                {{-- Extra Config Info --}}
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    @if(isset($config['os']))
                                                        <span class="text-xs bg-slate-50 border border-slate-100 px-2 py-1 rounded text-slate-500 font-medium">OS: <span class="uppercase">{{ $config['os'] }}</span></span>
                                                    @endif
                                                    @if(isset($config['datacenter']))
                                                        <span class="text-xs bg-slate-50 border border-slate-100 px-2 py-1 rounded text-slate-500 font-medium">DC: <span class="uppercase">{{ $config['datacenter'] }}</span></span>
                                                    @endif
                                                    @if(isset($config['domain_connection']))
                                                        <span class="text-xs bg-slate-50 border border-slate-100 px-2 py-1 rounded text-slate-500 font-medium">Domain: {{ $config['domain_connection'] }}</span>
                                                    @endif
                                                    @if(isset($config['notes']))
                                                        <span class="text-xs bg-slate-50 border border-slate-100 px-2 py-1 rounded text-slate-500 font-medium">{{ $config['notes'] }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="flex items-center sm:flex-col sm:items-end justify-between mt-4 sm:mt-0">
                                                <span class="font-black text-slate-900 text-xl">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                                <button type="button" onclick="triggerDelete('{{ route('cart.delete', $item->id) }}')" 
                                                    class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors text-sm font-bold flex items-center gap-1 mt-1">
                                                    <i class="ri-delete-bin-line"></i> <span class="sm:hidden">Hapus</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- KOLOM KANAN: SUMMARY --}}
                    <div class="lg:col-span-1 scroll-reveal" style="transition-delay: 100ms;">
                        <div class="bg-slate-900 p-8 rounded-3xl shadow-xl sticky top-32 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600 rounded-full blur-3xl -mr-16 -mt-16 opacity-50"></div>
                            
                            <h3 class="font-bold text-xl mb-6 flex items-center gap-2 relative z-10">
                                <i class="ri-bill-line"></i> Ringkasan Pesanan
                            </h3>

                            <div class="space-y-4 mb-8 relative z-10">
                                <div class="flex justify-between items-center text-sm text-slate-300">
                                    <span>Subtotal (<span id="summaryCount">{{ $items->count() }}</span> item)</span>
                                    <span class="font-bold text-white" id="summarySubtotal">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center text-sm text-slate-300">
                                    <span>PPN (11%)</span>
                                    <span class="font-bold text-white" id="summaryTax">Rp 0</span>
                                </div>
                                
                                <div class="border-t border-slate-700 border-dashed my-4"></div>
                                
                                <div class="flex justify-between items-end">
                                    <span class="font-bold">Total</span>
                                    <span class="text-3xl font-black text-blue-400" id="summaryTotal">Rp 0</span>
                                </div>
                            </div>
                            
                            <button type="submit" id="checkoutBtn" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-900/50 hover:bg-blue-500 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 relative z-10">
                                Lanjut Pembayaran <i class="ri-secure-payment-line"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </form>

            <form id="deleteForm" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        Swal.fire({
            title: 'Hapus Item?', 
            text: 'Apakah Anda yakin ingin menghapus layanan ini dari keranjang?', 
            icon: 'warning', 
            showCancelButton: true, 
            confirmButtonText: 'Ya, Hapus', 
            confirmButtonColor: '#ef4444',
            cancelButtonText: 'Batal'
        }).then((result) => { 
            if (result.isConfirmed) { 
                const form = document.getElementById('deleteForm');
                form.action = url;
                form.submit();
            } 
        })
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
                subtotal += parseInt(box.dataset.price);
                checkedCount++;
            }
        });

        const tax = subtotal * 0.11;
        const total = subtotal + tax;

        // Update UI
        document.getElementById('summaryCount').innerText = checkedCount;
        document.getElementById('summarySubtotal').innerText = formatRupiah(subtotal);
        document.getElementById('summaryTax').innerText = formatRupiah(tax);
        document.getElementById('summaryTotal').innerText = formatRupiah(total);

        // Handle Checkbox "Pilih Semua"
        const selectAllCb = document.getElementById('selectAll');
        if (selectAllCb) {
            selectAllCb.checked = (checkedCount === allCheckboxes.length && allCheckboxes.length > 0);
        }

        // Disable button jika tidak ada yg dipilih
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            if (checkedCount === 0) {
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                checkoutBtn.classList.remove('hover:bg-blue-500', 'hover:-translate-y-0.5');
            } else {
                checkoutBtn.disabled = false;
                checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                checkoutBtn.classList.add('hover:bg-blue-500', 'hover:-translate-y-0.5');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', calculateTotal);
    document.querySelectorAll('.item-checkbox').forEach(box => {
        box.addEventListener('change', calculateTotal);
    });
</script>
@endsection
