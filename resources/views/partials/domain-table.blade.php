<div class="overflow-x-auto relative">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4 w-1/4">TLD</th>
                <th class="px-6 py-4 w-1/5">Register</th>
                <th class="px-6 py-4 w-1/5">Renew</th>
                <th class="px-6 py-4 w-1/5">Transfer</th>
                <th class="px-6 py-4 w-1/6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm bg-white">
            @forelse($domains as $dom)
                @php
                    // Helper Calculation
                    $calcPrice = function($normal, $type, $config) {
                        $p_type = $config[$type]['type'] ?? 'none';
                        $p_val  = $config[$type]['value'] ?? 0;
                        $p_lbl  = $config[$type]['label'] ?? ''; // Label Acara (ex: Off 1st Year)
                        
                        $final = $normal;
                        $info  = ''; // Info Tipe (ex: Diskon 50% / Harga Spesial)

                        if ($p_type == 'percent' && $p_val > 0) {
                            $final = $normal - ($normal * ($p_val / 100));
                            $info  = "Diskon " . $p_val . "%";
                        } elseif ($p_type == 'fixed' && $p_val > 0) {
                            $final = $p_val;
                            $info  = "Harga Spesial";
                        }
                        
                        return [
                            'final'    => $final,
                            'is_promo' => $final < $normal,
                            'label'    => $p_lbl,
                            'info'     => $info
                        ];
                    };

                    $config = $dom->discount_config ?? [];
                    
                    // Hitung 3 Kolom
                    $reg   = $calcPrice($dom->price, 'register', $config);
                    $ren   = $calcPrice($dom->renew_price ?? $dom->price, 'renew', $config);
                    $trans = $calcPrice($dom->transfer_price ?? $dom->price, 'transfer', $config);

                    // Cek Promo Global Row
                    $hasAnyPromo = $reg['is_promo'] || $ren['is_promo'] || $trans['is_promo'];
                @endphp

                <tr class="hover:bg-blue-50/30 transition group relative">
                    
                    {{-- KOLOM 1: TLD + BADGE PROMO --}}
                    <td class="px-6 py-5 relative">
                        @if($hasAnyPromo)
                            <div class="absolute top-0 left-0 z-10">
                                <span class="bg-red-600 text-white text-[9px] font-bold px-2 py-1 rounded-br-lg shadow-sm tracking-wider">
                                    PROMO
                                </span>
                            </div>
                        @elseif($dom->tag)
                             <div class="absolute top-0 left-0 z-10">
                                <span class="bg-blue-600 text-white text-[9px] font-bold px-2 py-1 rounded-br-lg shadow-sm tracking-wider">
                                    {{ $dom->tag }}
                                </span>
                            </div>
                        @endif

                        <div class="flex items-center gap-2">
                            <span class="font-extrabold text-gray-800 text-lg">{{ $dom->name }}</span>
                            @if($dom->category == 'Popular')
                                <i class="ri-fire-fill text-orange-500" title="Populer"></i>
                            @endif
                        </div>
                    </td>

                    {{-- KOLOM 2: REGISTER --}}
                    <td class="px-6 py-5">
                        @if($reg['is_promo'])
                            <div class="flex flex-col items-start">
                                {{-- 1. Label Acara (Top) --}}
                                @if($reg['label'])
                                    <span class="text-[9px] font-bold text-red-600 uppercase bg-red-50 border border-red-100 px-1.5 py-0.5 rounded mb-1">
                                        {{ $reg['label'] }}
                                    </span>
                                @endif
                                
                                {{-- 2. Harga Final (Middle) --}}
                                <span class="font-extrabold text-red-600 text-lg leading-none">
                                    Rp {{ number_format($reg['final'], 0, ',', '.') }}
                                </span>

                                {{-- 3. Coret + Tipe Diskon (Bottom) --}}
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[11px] text-gray-400 line-through">
                                        Rp {{ number_format($dom->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] font-semibold text-gray-500">
                                        {{ $reg['info'] }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <span class="font-bold text-gray-800 text-lg">
                                Rp {{ number_format($dom->price, 0, ',', '.') }}
                            </span>
                        @endif
                    </td>

                    {{-- KOLOM 3: RENEW --}}
                    <td class="px-6 py-5 text-gray-600 font-medium">
                        @php $normalRen = $dom->renew_price ?? $dom->price; @endphp
                        @if($ren['is_promo'])
                            <div class="flex flex-col items-start">
                                @if($ren['label'])
                                    <span class="text-[9px] font-bold text-red-600 uppercase bg-red-50 border border-red-100 px-1.5 py-0.5 rounded mb-1">
                                        {{ $ren['label'] }}
                                    </span>
                                @endif
                                <span class="font-extrabold text-red-600 text-base leading-none">
                                    Rp {{ number_format($ren['final'], 0, ',', '.') }}
                                </span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[11px] text-gray-400 line-through">
                                        Rp {{ number_format($normalRen, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] font-semibold text-gray-500">
                                        {{ $ren['info'] }}
                                    </span>
                                </div>
                            </div>
                        @else
                            Rp {{ number_format($normalRen, 0, ',', '.') }}
                        @endif
                    </td>

                    {{-- KOLOM 4: TRANSFER --}}
                    <td class="px-6 py-5 text-gray-600 font-medium">
                        @php $normalTrans = $dom->transfer_price ?? $dom->price; @endphp
                        @if($trans['is_promo'])
                            <div class="flex flex-col items-start">
                                @if($trans['label'])
                                    <span class="text-[9px] font-bold text-red-600 uppercase bg-red-50 border border-red-100 px-1.5 py-0.5 rounded mb-1">
                                        {{ $trans['label'] }}
                                    </span>
                                @endif
                                <span class="font-extrabold text-red-600 text-base leading-none">
                                    Rp {{ number_format($trans['final'], 0, ',', '.') }}
                                </span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[11px] text-gray-400 line-through">
                                        Rp {{ number_format($normalTrans, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] font-semibold text-gray-500">
                                        {{ $trans['info'] }}
                                    </span>
                                </div>
                            </div>
                        @else
                            Rp {{ number_format($normalTrans, 0, ',', '.') }}
                        @endif
                    </td>

                    {{-- KOLOM 5: AKSI --}}
                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('domain.registration.detail') }}?tld={{ strtolower($dom->name) }}" 
                           class="w-full px-4 py-2.5 bg-white border-2 border-blue-600 text-blue-600 rounded-xl font-bold text-xs hover:bg-blue-600 hover:text-white transition shadow-sm flex justify-center items-center gap-2 group-hover:shadow-md text-decoration-none">
                            <i class="ri-search-line text-lg"></i>
                            <span>Cek</span>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 bg-gray-50">
                        <div class="flex flex-col items-center">
                            <i class="ri-search-eye-line text-4xl text-gray-300 mb-2"></i>
                            <span class="font-medium">Tidak ada domain ditemukan.</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINATION --}}
<div class="px-6 py-4 border-t border-gray-200 bg-gray-50" id="ajax-pagination-links">
    {{ $domains->links() }}
</div>