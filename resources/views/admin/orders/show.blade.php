@extends('layouts.admin-app')

@section('title', 'Detail Pesanan #' . $order->invoice_number)
@section('header_title', 'Detail Pesanan')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- Breadcrumb & Actions --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Invoice: <span class="font-mono text-blue-600">{{ $order->invoice_number }}</span>
            </h2>
            <p class="text-sm text-gray-500">Dibuat pada: {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>
            
            {{-- Tombol Delete Order (Hati-hati) --}}
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus order ini secara permanen?');">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 border border-red-200 rounded-lg hover:bg-red-200 transition">
                    <i class="ri-delete-bin-line"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-700 rounded-lg border border-green-200 flex items-center gap-2">
            <i class="ri-checkbox-circle-line text-xl"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- KOLOM KIRI: INFO ORDER & PELANGGAN --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- 1. Status & Pembayaran --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Pembayaran</h3>
                
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Status Saat Ini</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu Bayar)</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid / Active (Lunas)</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Metode Pembayaran</label>
                        <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 font-medium capitalize">
                            {{ str_replace('_', ' ', $order->payment_method) }}
                        </div>
                    </div>

                    <div class="md:col-span-2 text-right">
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm">
                            Update Status Order
                        </button>
                    </div>
                </form>
            </div>

            {{-- 2. ITEM ORDER & SETUP TEKNIS --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Item Pesanan & Konfigurasi</h3>
                    <span class="text-xs font-medium text-gray-500">{{ $order->items->count() }} Item</span>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-4">
                                {{-- Detail Produk --}}
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                                        @if($item->type == 'vps') <i class="ri-server-line"></i>
                                        @elseif($item->type == 'domain') <i class="ri-global-line"></i>
                                        @else <i class="ri-hard-drive-2-line"></i> @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $item->product_name }}</h4>
                                        <div class="text-sm text-gray-500">
                                            <span class="capitalize bg-gray-100 px-2 py-0.5 rounded text-xs">{{ $item->type }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $item->billing_cycle }}</span>
                                        </div>
                                        <div class="text-sm font-bold text-blue-600 mt-1">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Config Badge (User Request) --}}
                                <div class="text-right">
                                    @php $config = $item->configuration ?? []; @endphp
                                    @if(isset($config['os']))
                                        <span class="block text-xs text-gray-500">OS: <span class="font-bold">{{ $config['os'] }}</span></span>
                                    @endif
                                    @if(isset($config['domain_connection']))
                                        <span class="block text-xs text-gray-500">Domain: <span class="font-bold">{{ $config['domain_connection'] }}</span></span>
                                    @endif
                                    @if(isset($config['datacenter']))
                                        <span class="block text-xs text-gray-500">Loc: <span class="font-bold">{{ $config['datacenter'] }}</span></span>
                                    @endif
                                </div>
                            </div>

                            {{-- === FORM SETUP TEKNIS (KHUSUS ADMIN) === --}}
                            <div class="bg-blue-50/50 border border-blue-100 rounded-lg p-4 mt-2">
                                <h5 class="text-xs font-bold text-blue-800 uppercase tracking-wide mb-3 flex items-center gap-2">
                                    <i class="ri-settings-5-fill"></i> Setup Teknis (Akan tampil di Client Area)
                                </h5>
                                
                                <form action="{{ route('admin.order-items.update-config', $item->id) }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        {{-- IP Address --}}
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">IP Address</label>
                                            <input type="text" name="ip_address" 
                                                value="{{ $config['ip_address'] ?? '' }}" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700" 
                                                placeholder="Contoh: 103.166.x.x">
                                        </div>

                                        {{-- Username --}}
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Username (SSH/cPanel)</label>
                                            <input type="text" name="username" 
                                                value="{{ $config['username'] ?? '' }}" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700" 
                                                placeholder="root / admin">
                                        </div>

                                        {{-- Password (Optional) --}}
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Password (Opsional)</label>
                                            <input type="text" name="password" 
                                                value="{{ $config['password'] ?? '' }}" 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none text-gray-700" 
                                                placeholder="Isi untuk ubah">
                                        </div>
                                    </div>
                                    <div class="mt-3 text-right">
                                        <button type="submit" class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition">
                                            Simpan Konfigurasi
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{-- END FORM SETUP --}}

                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN: RINGKASAN TAGIHAN & USER --}}
        <div class="space-y-6">
            
            {{-- Data Pelanggan --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-user-line text-blue-500"></i> Informasi Pelanggan
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm text-gray-800">{{ $order->user->name }}</p>
                            <p class="text-xs text-gray-500">ID: #{{ $order->user->id }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-gray-100 text-sm">
                        <div class="flex gap-2 mb-2">
                            <i class="ri-mail-line text-gray-400"></i>
                            <span class="text-gray-600 truncate">{{ $order->user->email }}</span>
                        </div>
                        <div class="flex gap-2">
                            <i class="ri-phone-line text-gray-400"></i>
                            <span class="text-gray-600">{{ $order->user->phone ?? '-' }}</span>
                        </div>
                    </div>
                    <a href="#" class="block text-center mt-4 w-full py-2 bg-gray-50 text-gray-600 text-xs font-bold rounded border border-gray-200 hover:bg-gray-100">
                        Lihat Profil User
                    </a>
                </div>
            </div>

            {{-- Bukti Pembayaran --}}
            @if($order->payment_proof)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="ri-image-line text-blue-500"></i> Bukti Transfer
                    </h3>
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block w-full aspect-video rounded-lg overflow-hidden border border-gray-200 hover:opacity-90 transition">
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" class="w-full h-full object-cover">
                    </a>
                    <p class="text-xs text-gray-500 mt-2 text-center">Klik gambar untuk memperbesar</p>
                </div>
            @endif

            {{-- Ringkasan Tagihan --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="ri-bill-line text-blue-500"></i> Ringkasan Tagihan
                </h3>
                
                {{-- Hitung Subtotal manual utk display --}}
                @php
                    $subtotal = $order->total_amount / 1.11; // Asumsi PPN 11% included
                    $tax = $order->total_amount - $subtotal;
                @endphp

                <div class="space-y-2 text-sm mb-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Pajak (11%)</span>
                        <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="pt-3 border-t border-gray-200 flex justify-between items-center">
                    <span class="font-bold text-gray-800">Total Bayar</span>
                    <span class="font-bold text-xl text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>

                @if($order->status == 'pending')
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-xs text-yellow-700 text-center">
                        <i class="ri-alert-line"></i> Pesanan belum dibayar.
                    </div>
                @elseif($order->status == 'paid')
                    <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded text-xs text-green-700 text-center">
                        <i class="ri-check-double-line"></i> Lunas pada {{ optional($order->paid_at)->format('d M Y') ?? 'Manual' }}
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>
@endsection