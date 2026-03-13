@extends('layouts.landing')

@section('title', 'Selesaikan Pembayaran')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* Enhanced Radio Button Style */
        .payment-radio:checked+div {
            border-color: #2563eb;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            box-shadow: 0 4px 12px -1px rgba(37, 99, 235, 0.2), 0 2px 6px -1px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        .payment-radio:checked+div .radio-icon {
            display: block;
            color: #2563eb;
            animation: checkPop 0.3s ease;
        }

        .payment-radio+div {
            transition: all 0.3s ease;
        }

        .payment-radio+div:hover {
            border-color: #60a5fa;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px -1px rgba(0, 0, 0, 0.1);
        }

        @keyframes checkPop {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @media (min-width: 1024px) {
            .sticky-summary {
                position: sticky;
                top: 6rem;
            }
        }

        .payment-logo-container {
            width: 60px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 8px;
            padding: 4px;
            border: 1px solid #e5e7eb;
        }
        
        .payment-logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
@endsection

@section('content')
    <div class="pt-20 sm:pt-24 lg:pt-28 pb-32 lg:pb-24 bg-gradient-to-br from-gray-50 via-blue-50/30 to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8 sm:mb-10 text-center">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-2">Selesaikan Pembayaran</h1>
                <p class="text-gray-500 text-sm sm:text-base max-w-2xl mx-auto">
                    Pilih metode pembayaran yang aman dan nyaman.
                </p>
            </div>

            {{-- Form Pembayaran --}}
            <form action="#" method="POST" id="paymentForm">
                @csrf
                
                {{-- Validasi agar $items tidak kosong --}}
                @if(isset($items) && $items->count() > 0)
                    @foreach ($items as $item)
                        <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                    @endforeach
                @else
                    {{-- Fallback jika user refresh halaman ini tanpa via cart --}}
                    <script>window.location.href = "{{ route('cart.index') }}";</script>
                @endif
                
                <input type="hidden" name="total_amount" value="{{ $total }}">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                    <!-- KOLOM KIRI: METODE BAYAR -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        {{-- 1. PILIH METODE --}}
                        <div class="bg-white p-6 rounded-2xl border-2 border-gray-200 shadow-md">
                            <h3 class="font-bold text-gray-900 text-lg mb-4">Metode Pembayaran</h3>
                            
                            <div class="space-y-4">
                                {{-- QRIS (MANUAL) --}}
                                <label class="cursor-pointer block relative group">
                                    <input type="radio" name="payment_method" value="qris_manual" class="payment-radio sr-only">
                                    <div class="border-2 border-gray-200 rounded-xl p-5 flex items-center justify-between bg-white">
                                        <div class="flex items-center gap-4">
                                            <div class="payment-logo-container">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png" class="payment-logo" alt="QRIS">
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-900">QRIS (Scan Barcode)</span>
                                                <span class="text-xs text-gray-500">BCA, GoPay, OVO, Dana, ShopeePay</span>
                                            </div>
                                        </div>
                                        <i class="ri-checkbox-circle-fill radio-icon hidden text-2xl ml-3"></i>
                                    </div>
                                </label>

                                {{-- 2. BANK BNI (MANUAL) --}}
                                <label class="cursor-pointer block relative group">
                                    <input type="radio" name="payment_method" value="bank_bni" class="payment-radio sr-only">
                                    <div class="border-2 border-gray-200 rounded-xl p-5 flex items-center justify-between bg-white">
                                        <div class="flex items-center gap-4">
                                            <div class="payment-logo-container">
                                                {{-- LOGO BARU (CDN STABIL) --}}
                                                <img src="{{ asset('assets/bni.png') }}" class="payment-logo" alt="BNI">
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-900">Transfer Bank BNI</span>
                                                <span class="text-xs text-gray-500">Cek Manual (Upload Bukti)</span>
                                            </div>
                                        </div>
                                        <i class="ri-checkbox-circle-fill radio-icon hidden text-2xl ml-3"></i>
                                    </div>
                                </label>
                            </div>

                            <!-- Info Penting -->
                            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl flex gap-3 text-sm text-yellow-800">
                                <i class="ri-error-warning-line text-xl flex-shrink-0"></i>
                                <p>Layanan akan aktif setelah Admin memverifikasi pembayaran Anda (Maks. 1x24 Jam).</p>
                            </div>
                        </div>

                        {{-- 2. RINCIAN ITEM (DITAMPILKAN JUGA DI SINI) --}}
                        <div class="bg-white p-6 rounded-2xl border-2 border-gray-200 shadow-sm">
                            <h3 class="font-bold text-gray-900 text-lg mb-4">Item yang Dibeli</h3>
                            <div class="space-y-3">
                                @foreach($items as $item)
                                    <div class="flex justify-between items-center text-sm border-b border-gray-100 pb-2 last:border-0">
                                        <div>
                                            <span class="font-bold text-gray-800 block">{{ $item->product_name }}</span>
                                            <span class="text-xs text-gray-500 capitalize">{{ $item->type }} &bull; {{ $item->billing_cycle }}</span>
                                        </div>
                                        <span class="font-semibold text-gray-700">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: RINGKASAN -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-xl border-2 border-gray-200 overflow-hidden sticky-summary">
                            <div class="bg-gray-900 px-6 py-5">
                                <h3 class="font-bold text-white text-lg">Total Tagihan</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>Subtotal</span>
                                        <span class="font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>PPN (11%)</span>
                                        <span class="font-bold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="border-t pt-3 flex justify-between items-center">
                                        <span class="font-bold text-lg">Total</span>
                                        <span class="font-extrabold text-xl text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <button type="button" onclick="processPayment()" class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                                    <i class="ri-secure-payment-line text-lg"></i> Bayar Sekarang
                                </button>
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

            if (!formData.get('payment_method')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Metode Pembayaran',
                    text: 'Silakan pilih salah satu metode pembayaran untuk melanjutkan.',
                    confirmButtonColor: '#2563eb'
                });
                return;
            }

            Swal.fire({
                title: 'Memproses Pesanan...',
                text: 'Mohon tunggu sebentar',
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
                    // Redirect ke halaman instruksi transfer
                    window.location.href = data.redirect_instruction;
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
            });
        }
    </script>
@endsection