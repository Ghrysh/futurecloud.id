@extends('layouts.admin-app')

@section('title', 'Daftar Pesanan')
@section('header_title', 'Kelola Pesanan')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Riwayat Transaksi</h3>
        {{-- Bisa ditambah fitur search nanti --}}
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="p-4 border-b">Invoice</th>
                    <th class="p-4 border-b">Pelanggan</th>
                    <th class="p-4 border-b">Total</th>
                    <th class="p-4 border-b">Metode</th>
                    <th class="p-4 border-b text-center">Status</th>
                    <th class="p-4 border-b text-center">Tanggal</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-mono font-medium text-blue-600">
                        {{ $order->invoice_number }}
                    </td>
                    <td class="p-4">
                        <div class="font-bold">{{ $order->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                    </td>
                    <td class="p-4 font-bold">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="p-4 capitalize">
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs border border-gray-200">
                            {{ str_replace('_', ' ', $order->payment_method) }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        @php
                            $statusClass = match($order->status) {
                                'paid', 'active' => 'bg-green-100 text-green-700 border-green-200',
                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }} capitalize">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="p-4 text-center text-xs text-gray-500">
                        {{ $order->created_at->format('d M Y') }}<br>
                        {{ $order->created_at->format('H:i') }}
                    </td>
                    <td class="p-4 text-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                           class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition font-medium text-xs border border-blue-200">
                            <i class="ri-eye-line mr-1"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500">
                        Belum ada pesanan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection