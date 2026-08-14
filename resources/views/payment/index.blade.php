@extends('layouts.landing')

@section('title', 'Selesaikan Pembayaran')

@section('content')
<div class="bg-slate-50 min-h-screen pt-28 pb-24 relative overflow-hidden font-['Inter']">
    {{-- Latar Dekoratif --}}
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] bg-indigo-50 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10 scroll-reveal">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Penyelesaian Pesanan</h1>
            <p class="text-slate-500 mt-3 font-medium text-lg">Langkah terakhir untuk mengaktifkan layanan premium Anda.</p>
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
                                <div class="group flex justify-between items-center p-5 bg-white hover:bg-blue-50/50 rounded-2xl border border-slate-200 transition-all hover:shadow-md hover:border-blue-200">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-xl bg-slate-50 flex items-center justify-center border border-slate-100 group-hover:scale-110 transition-transform">
                                            @if($item->type == 'domain')
                                                <i class="ri-global-line text-3xl text-blue-500"></i>
                                            @elseif($item->type == 'vps')
                                                <i class="ri-server-line text-3xl text-indigo-500"></i>
                                            @elseif($item->type == 'hosting')
                                                <i class="ri-cloud-line text-3xl text-orange-500"></i>
                                            @else
                                                <i class="ri-box-3-line text-3xl text-emerald-500"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-900 text-lg">{{ $item->product_name }}</h4>
                                            <p class="text-sm text-slate-500 font-medium capitalize mt-1"><span class="bg-slate-100 px-2 py-0.5 rounded text-xs text-slate-600">{{ $item->type }}</span> &bull; {{ str_replace(' Year(s)', ' Tahun', $item->billing_cycle) }}</p>
                                        </div>
                                    </div>
                                    <div class="font-black text-slate-800 text-lg">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-slate-100 pb-4">
                            <i class="ri-secure-payment-line text-blue-600"></i> Metode Pembayaran
                        </h3>

                        <div class="p-6 border-2 border-blue-600 bg-blue-50/50 rounded-2xl shadow-sm relative overflow-hidden group cursor-pointer transition-all hover:shadow-md">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-200 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none opacity-50 group-hover:opacity-100 transition-opacity"></div>
                            
                            <div class="flex items-start gap-5 relative z-10">
                                <div class="w-20 h-14 bg-white rounded-xl flex items-center justify-center p-2 shadow-sm border border-blue-100 shrink-0 group-hover:scale-105 transition-transform">
                                    <img src="{{ asset('assets/bni.webp') }}" alt="BNI" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-900 text-lg">Transfer Bank BNI (Verifikasi Manual)</h4>
                                    <p class="text-sm text-slate-600 mt-2 leading-relaxed">Pembayaran ditujukan ke rekening operasional <strong class="text-slate-800">Berkah Teknologi Terdepan</strong>. Anda akan diinstruksikan untuk mengunggah bukti transfer (struk/screenshot) pada langkah selanjutnya.</p>
                                </div>
                                <div class="ml-auto flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white shrink-0 shadow-sm shadow-blue-600/30">
                                    <i class="ri-check-line font-bold"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: INVOICE TOTAL --}}
                <div class="lg:col-span-1 scroll-reveal" style="transition-delay: 100ms;">
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl shadow-blue-900/5 border border-slate-200 overflow-hidden sticky top-32">
                        
                        <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-8 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none opacity-40"></div>
                            <h3 class="font-bold text-white text-lg relative z-10 flex items-center gap-2">
                                <i class="ri-bill-line text-blue-400 text-2xl"></i> Rincian Tagihan
                            </h3>
                        </div>

                        <div class="p-8">
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500 font-medium">Subtotal</span>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500 font-medium">PPN (11%)</span>
                                    <span class="font-bold text-slate-800">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="border-t-2 border-slate-100 border-dashed my-6"></div>
                                
                                <div class="flex justify-between items-end">
                                    <span class="font-bold text-slate-500 uppercase tracking-wider text-xs mb-1">Total Bayar</span>
                                    <span class="text-3xl font-black text-blue-600 tracking-tight leading-none">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <button type="button" onclick="processPayment()" class="w-full py-4 bg-blue-600 text-white rounded-xl font-extrabold text-lg shadow-xl shadow-blue-600/20 hover:bg-blue-700 hover:-translate-y-1 transition-all flex items-center justify-center gap-2 group">
                                Selesaikan Pesanan <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                            </button>
                            
                            <p class="text-xs text-center text-slate-400 mt-6 font-medium flex items-center justify-center gap-1">
                                <i class="ri-lock-2-line text-emerald-500"></i> Transaksi Anda aman dan terenkripsi.
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
