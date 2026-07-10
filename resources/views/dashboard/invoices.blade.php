@extends('layouts.client-app')

@section('title', 'Invoices')

@section('content')

    {{-- Header Page --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tagihan Saya</h1>
            <p class="text-sm text-gray-500">Kelola dan bayar tagihan layanan Anda</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        @if(count($invoices) > 0)
            
            {{-- ================= DESKTOP VIEW (TABLE) ================= --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">No Invoice</th>
                            <th class="px-6 py-4">Detail Layanan</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($invoices as $inv)
                        
                        {{-- LOGIKA NAMA ITEM (Ambil item pertama + count sisanya) --}}
                        @php
                            $firstItem = $inv->items->first();
                            $moreCount = $inv->items->count() - 1;
                            $itemName = $firstItem ? $firstItem->product_name : 'Layanan Terhapus';
                            if($moreCount > 0) {
                                $itemName .= ' (+' . $moreCount . ' item lainnya)';
                            }
                        @endphp

                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-6 py-4 font-medium text-blue-600">
                                <a href="{{ route('client.invoices.download', $inv->id) }}" class="hover:underline">
                                    {{ $inv->invoice_number }}
                                </a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $itemName }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $inv->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                Rp {{ number_format($inv->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(in_array(strtolower($inv->status), ['paid', 'active', 'success']))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Lunas
                                    </span>
                                @elseif($inv->status == 'cancelled')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                        Batal
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span> Belum Bayar
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if(!in_array(strtolower($inv->status), ['paid', 'active', 'success', 'cancelled']))
                                    <a href="{{ route('order.instruction', $inv->id) }}"
                                       class="inline-flex items-center justify-center p-2 text-blue-600 hover:text-blue-700 rounded-full hover:bg-blue-50 transition"
                                       title="Bayar Sekarang">
                                        <i class="ri-wallet-3-line text-lg"></i>
                                    </a>
                                @endif
                                <a href="{{ route('client.invoices.download', $inv->id) }}" 
                                   class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50 transition" 
                                   title="Download PDF">
                                    <i class="ri-download-cloud-2-line text-lg"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ================= MOBILE VIEW (CARDS) ================= --}}
            <div class="md:hidden flex flex-col divide-y divide-gray-100">
                @foreach($invoices as $inv)
                
                {{-- LOGIKA ITEM NAME UNTUK MOBILE --}}
                @php
                    $firstItem = $inv->items->first();
                    $moreCount = $inv->items->count() - 1;
                    $itemName = $firstItem ? $firstItem->product_name : 'Layanan Terhapus';
                    if($moreCount > 0) $itemName .= ' (+' . $moreCount . ' item)';
                @endphp

                <div class="p-5 hover:bg-gray-50 transition">
                    {{-- Header Card --}}
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <span class="text-xs text-gray-500 block mb-1">{{ $inv->created_at->format('d M Y') }}</span>
                            <span class="text-blue-600 font-bold text-sm">{{ $inv->invoice_number }}</span>
                        </div>
                        @if(in_array(strtolower($inv->status), ['paid', 'active']))
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-[10px] font-bold uppercase tracking-wide border border-green-200">Lunas</span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-[10px] font-bold uppercase tracking-wide border border-yellow-200">Pending</span>
                        @endif
                    </div>

                    {{-- Body Card --}}
                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-1">{{ $itemName }}</h3>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($inv->total_amount, 0, ',', '.') }}</p>
                    </div>

                    {{-- Footer/Action Card --}}
                    <div class="flex gap-3">
                        <a href="{{ route('client.invoices.download', $inv->id) }}" 
                           class="flex-1 py-2 bg-white border border-gray-300 text-gray-600 rounded-lg text-xs font-semibold hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition flex items-center justify-center gap-2">
                            <i class="ri-download-line"></i> Unduh PDF
                        </a>
                        
                        @if(!in_array(strtolower($inv->status), ['paid', 'active', 'success', 'cancelled']))
                            <a href="{{ route('order.instruction', $inv->id) }}" class="flex-1 py-2 bg-blue-600 text-white text-center rounded-lg text-xs font-semibold hover:bg-blue-700 transition shadow-sm shadow-blue-200 block">
                                Bayar
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        @else
            {{-- EMPTY STATE --}}
            <div class="p-12 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="ri-file-list-3-line text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum Ada Tagihan</h3>
                <p class="text-gray-500 text-sm max-w-xs mx-auto mt-1">Anda tidak memiliki riwayat tagihan saat ini. Tagihan baru akan muncul di sini.</p>
            </div>
        @endif

    </div>

@endsection