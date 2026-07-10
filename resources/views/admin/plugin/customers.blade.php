@extends('layouts.admin-app')

@section('title', 'Pelanggan Plugin')
@section('header_title', 'Daftar Pelanggan Plugin & Lisensi')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Pelanggan Plugin</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data pelanggan yang telah membeli Plugin dan Lisensinya.</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-gray-900">Pelanggan</th>
                        <th class="px-6 py-4 font-semibold text-gray-900">Invoice / Tgl Beli</th>
                        <th class="px-6 py-4 font-semibold text-gray-900">Produk Plugin</th>
                        <th class="px-6 py-4 font-semibold text-gray-900">Kode Lisensi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($customers as $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $item->order->user->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-500">{{ $item->order->user->email ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-blue-600">{{ $item->order->invoice_number }}</div>
                                <div class="text-xs text-gray-500">{{ $item->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-lg text-xs font-semibold border border-purple-100">
                                    {{ $item->product_name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $config = json_decode($item->configuration, true) ?? [];
                                    $status = $item->order->status ?? 'pending';
                                @endphp
                                @if(in_array($status, ['paid', 'active']))
                                    @php
                                        $license = $config['license_key'] ?? 'Tidak Ada';
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <code class="px-2 py-1 bg-green-50 text-green-700 rounded font-mono text-xs font-bold border border-green-200">
                                            {{ $license }}
                                        </code>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-1 bg-orange-50 text-orange-700 rounded text-xs font-semibold border border-orange-200">
                                            Menunggu Pembayaran
                                        </span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Belum ada pelanggan yang membeli plugin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
