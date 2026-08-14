@extends('layouts.landing')

@section('title', 'Selesaikan Pembayaran')

@section('content')
<div class="bg-slate-50 min-h-screen pt-28 pb-24 relative overflow-hidden font-['Inter']">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] bg-slate-200 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10 scroll-reveal">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Checkout</h1>
            <p class="text-slate-500 mt-3 font-medium">Langkah terakhir sebelum layanan Anda aktif.</p>
        </div>

        <form action="#" method="POST" id="paymentForm">
            @csrf
            
            @if(isset($items) && $items->count() > 0)
                @foreach ($items as $item)
                    <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                @endforeach
            @else
                <script>window.location.href = "{{ route('cart.index') }}";</script>
            @endif
            
            <input type="hidden" name="total_amount" value="{{ $total }}">
            {{-- Default always bank_bni --}}
            <input type="hidden" name="payment_method" value="bank_bni">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: RINCIAN ORDER --}}
                <div class="lg:col-span-2 space-y-6 scroll-reveal">
                    
                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-slate-100 pb-4">
                            <i class="ri-shopping-bag-3-line text-blue-600"></i> Ringkasan Pesanan Anda
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($items as $item)
                                <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center border border-slate-200 shadow-sm shrink-0">
                                            @if($item->type == 'domain')
                                                <i class="ri-global-line text-2xl text-blue-500"></i>
                                            @elseif($item->type == 'vps')
                                                <i class="ri-server-line text-2xl text-indigo-500"></i>
                                            @elseif($item->type == 'hosting')
                                                <i class="ri-cloud-line text-2xl text-orange-500"></i>
                                            @else
                                                <i class="ri-box-3-line text-2xl text-emerald-500"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-900">{{ $item->product_name }}</h4>
                                            <p class="text-xs text-slate-500 font-medium capitalize">{{ $item->type }} &bull; {{ str_replace(' Year(s)', ' Tahun', $item->billing_cycle) }}</p>
                                        </div>
                                    </div>
                                    <div class="font-bold text-slate-800">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-slate-100 pb-4">
                            <i class="ri-bank-card-line text-blue-600"></i> Metode Pembayaran
                        </h3>

                        <div class="p-6 border-2 border-blue-600 bg-blue-50/50 rounded-2xl shadow-sm shadow-blue-900/5 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
                            
                            <div class="flex items-start gap-5 relative z-10">
                                <div class="w-16 h-12 bg-white rounded-xl flex items-center justify-center p-2 shadow-sm border border-blue-100 shrink-0">
                                    <img src="{{ asset('assets/bni.webp') }}" alt="BNI" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-lg">Transfer Manual Bank BNI</h4>
                                    <p class="text-sm text-slate-600 mt-1">Pembayaran ditujukan ke rekening <strong>Berkah Teknologi Terdepan</strong>. Anda akan diinstruksikan untuk mengunggah bukti transfer pada halaman selanjutnya.</p>
                                </div>
                                <div class="ml-auto flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white shrink-0 shadow-sm">
                                    <i class="ri-check-line font-bold"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: INVOICE TOTAL --}}
                <div class="lg:col-span-1 scroll-reveal" style="transition-delay: 100ms;">
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden sticky top-32">
                        
                        <div class="bg-slate-900 p-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-800 rounded-full blur-2xl -mr-16 -mt-16 pointer-events-none"></div>
                            <h3 class="font-bold text-white text-lg relative z-10 flex items-center gap-2">
                                <i class="ri-bill-line"></i> Total Tagihan
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500 font-medium">Subtotal</span>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500 font-medium">PPN (11%)</span>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="border-t border-slate-100 border-dashed my-4"></div>
                                
                                <div class="flex justify-between items-end">
                                    <span class="font-bold text-slate-800">Total</span>
                                    <span class="text-3xl font-black text-blue-600 tracking-tight">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <button type="button" onclick="processPayment()" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                Buat Pesanan <i class="ri-arrow-right-line"></i>
                            </button>
                            
                            <p class="text-xs text-center text-slate-400 mt-4 font-medium">
                                <i class="ri-lock-line"></i> Transaksi Anda aman dan terenkripsi.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function processPayment() {
        const form = document.getElementById('paymentForm');
        const formData = new FormData(form);

        Swal.fire({
            title: 'Memproses Pesanan...',
            text: 'Mempersiapkan instruksi pembayaran Anda.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch("{{ route('order.store') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = data.redirect_instruction;
            } else {
                if (data.redirect_instruction) {
                    Swal.fire({
                        title: 'Info',
                        text: data.message,
                        icon: 'info',
                        confirmButtonText: 'Ke Client Area',
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = data.redirect_instruction;
                    });
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
        });
    }
</script>
@endsection
