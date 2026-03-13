<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 text-gray-500 uppercase font-bold text-xs border-b border-gray-200">
            <tr>
                <th class="px-6 py-4">Nama Produk</th>
                <th class="px-6 py-4">Kategori</th>
                
                {{-- Dynamic Headers based on Type --}}
                @if($type == 'domain')
                    <th class="px-6 py-4">Register</th>
                    <th class="px-6 py-4">Diskon Reg</th>
                    <th class="px-6 py-4">Renew</th>
                    <th class="px-6 py-4">Diskon Renew</th>
                    <th class="px-6 py-4">Transfer</th>
                    <th class="px-6 py-4">Diskon Transfer</th>
                @else
                    <th class="px-6 py-4">Harga Normal</th>
                    <th class="px-6 py-4">Harga Diskon</th>
                @endif

                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($products as $p)
                <tr class="hover:bg-gray-50 transition">
                    {{-- 1. NAMA PRODUK --}}
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-800 text-base">{{ $p->name }}</div>
                        <div class="text-xs text-gray-400">{{ $p->slug }}</div>
                        @if($p->tag)
                            <span class="inline-block mt-1 px-2 py-0.5 bg-blue-100 text-blue-700 rounded text-[10px] font-bold">
                                {{ $p->tag }}
                            </span>
                        @endif
                    </td>

                    {{-- 2. KATEGORI --}}
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 rounded text-xs text-gray-600 border border-gray-200">
                            {{ $p->category ?? 'General' }}
                        </span>
                    </td>

                    @if($type == 'domain')
                        {{-- 3. REGISTER --}}
                        <td class="px-6 py-4 font-medium text-gray-600">
                            Rp {{ number_format($p->price, 0, ',', '.') }}
                        </td>
                        
                        {{-- 4. DISKON REGISTER --}}
                        <td class="px-6 py-4">
                            @php
                                $regConfig = $p->discount_config['register'] ?? [];
                                $regFinal = $p->price;
                                $regType = $regConfig['type'] ?? 'none';
                                $regVal = $regConfig['value'] ?? 0;

                                if ($regType == 'percent' && $regVal > 0) {
                                    $regFinal = $p->price - ($p->price * ($regVal / 100));
                                } elseif ($regType == 'fixed' && $regVal > 0) {
                                    $regFinal = $regVal;
                                }
                            @endphp

                            @if($regFinal < $p->price)
                                <div class="text-green-600 font-bold">
                                    Rp {{ number_format($regFinal, 0, ',', '.') }}
                                </div>
                                <span class="text-[10px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold">
                                    {{ $regType == 'percent' ? "Diskon $regVal%" : 'Special Price' }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                        {{-- 5. RENEW --}}
                        <td class="px-6 py-4 text-gray-600">
                            Rp {{ number_format($p->renew_price, 0, ',', '.') }}
                        </td>

                        {{-- 6. DISKON RENEW --}}
                        <td class="px-6 py-4">
                            @php
                                $renewConfig = $p->discount_config['renew'] ?? [];
                                $renewNormal = $p->renew_price;
                                $renewFinal = $renewNormal;
                                $renewType = $renewConfig['type'] ?? 'none';
                                $renewVal = $renewConfig['value'] ?? 0;

                                if ($renewType == 'percent' && $renewVal > 0) {
                                    $renewFinal = $renewNormal - ($renewNormal * ($renewVal / 100));
                                } elseif ($renewType == 'fixed' && $renewVal > 0) {
                                    $renewFinal = $renewVal;
                                }
                            @endphp

                            @if($renewFinal < $renewNormal)
                                <div class="text-green-600 font-bold">
                                    Rp {{ number_format($renewFinal, 0, ',', '.') }}
                                </div>
                                <span class="text-[10px] bg-orange-100 text-orange-600 px-1.5 py-0.5 rounded font-bold">
                                    {{ $renewType == 'percent' ? "Diskon $renewVal%" : 'Special' }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                        {{-- 7. TRANSFER --}}
                        <td class="px-6 py-4 text-gray-600">
                            Rp {{ number_format($p->transfer_price, 0, ',', '.') }}
                        </td>

                        {{-- 8. DISKON TRANSFER --}}
                        <td class="px-6 py-4">
                            @php
                                $transConfig = $p->discount_config['transfer'] ?? [];
                                $transNormal = $p->transfer_price;
                                $transFinal = $transNormal;
                                $transType = $transConfig['type'] ?? 'none';
                                $transVal = $transConfig['value'] ?? 0;

                                if ($transType == 'percent' && $transVal > 0) {
                                    $transFinal = $transNormal - ($transNormal * ($transVal / 100));
                                } elseif ($transType == 'fixed' && $transVal > 0) {
                                    $transFinal = $transVal;
                                }
                            @endphp

                            @if($transFinal < $transNormal)
                                <div class="text-green-600 font-bold">
                                    Rp {{ number_format($transFinal, 0, ',', '.') }}
                                </div>
                                <span class="text-[10px] bg-purple-100 text-purple-600 px-1.5 py-0.5 rounded font-bold">
                                    {{ $transType == 'percent' ? "Diskon $transVal%" : 'Special' }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>

                    @else
                        {{-- LOGIC UNTUK NON-DOMAIN (VPS/HOSTING) --}}
                        
                        {{-- HARGA NORMAL --}}
                        <td class="px-6 py-4 font-medium text-gray-600">
                            @php
                                // Default Monthly
                                $monthlyConfig = $p->discount_config['monthly'] ?? [];
                                $normalPrice = $p->price;
                                // Jika ada custom price
                                if(!empty($monthlyConfig['custom_price']) && $monthlyConfig['custom_price'] > 0) {
                                    $normalPrice = $monthlyConfig['custom_price'];
                                }
                            @endphp
                            Rp {{ number_format($normalPrice, 0, ',', '.') }}
                            <span class="text-xs text-gray-400 block">/ bln</span>
                        </td>

                        {{-- HARGA DISKON --}}
                        <td class="px-6 py-4">
                            @php
                                $finalPrice = $normalPrice;
                                $typeConfig = $monthlyConfig['type'] ?? 'none';
                                $valConfig = $monthlyConfig['value'] ?? 0;

                                if ($typeConfig == 'percent' && $valConfig > 0) {
                                    $finalPrice = $normalPrice - ($normalPrice * ($valConfig / 100));
                                } elseif ($typeConfig == 'fixed' && $valConfig > 0) {
                                    $finalPrice = $valConfig;
                                }
                            @endphp

                            @if($finalPrice < $normalPrice)
                                <div class="text-green-600 font-bold">
                                    Rp {{ number_format($finalPrice, 0, ',', '.') }}
                                </div>
                                <span class="text-[10px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold">
                                    {{ $typeConfig == 'percent' ? "Diskon $valConfig%" : 'Special Price' }}
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                    @endif

                    {{-- AKSI --}}
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $p->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                <i class="ri-pencil-line text-lg"></i>
                            </a>
                            <button type="button" onclick="deleteProduct({{ $p->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                <i class="ri-delete-bin-line text-lg"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $type == 'domain' ? 9 : 6 }}" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="ri-inbox-line text-4xl text-gray-300 mb-2"></i>
                            <p>Tidak ada data ditemukan untuk {{ ucfirst($type) }}.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination Container --}}
<div class="px-6 py-4 border-t border-gray-100" id="pagination-links">
    {{ $products->links() }}
</div>