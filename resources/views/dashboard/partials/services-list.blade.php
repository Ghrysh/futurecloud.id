{{-- 1. CONTENT --}}
@if($services->count() > 0)
    
    {{-- A. DESKTOP VIEW (TABLE) --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold tracking-wider">
                    <th class="px-6 py-4 border-b border-gray-100">Layanan / Produk</th>
                    <th class="px-6 py-4 border-b border-gray-100">IP Address / Domain / Lisensi</th>
                    <th class="px-6 py-4 border-b border-gray-100">Siklus Tagihan</th>
                    <th class="px-6 py-4 border-b border-gray-100">Jatuh Tempo</th>
                    <th class="px-6 py-4 border-b border-gray-100 text-center">Status</th>
                    <th class="px-6 py-4 border-b border-gray-100 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100 bg-white">
                @foreach($services as $service)
                    {{-- LOGIKA HITUNG DUE DATE --}}
                    @php
                        $createdAt = \Carbon\Carbon::parse($service->created_at);
                        $dueDate = $createdAt->copy();
                        
                        // Parsing siklus tagihan
                        $cycle = strtolower($service->billing_cycle);
                        
                        if (str_contains($cycle, 'month')) {
                            $dueDate->addMonth();
                        } elseif (str_contains($cycle, 'annual') || str_contains($cycle, 'year')) {
                            if (preg_match('/(\d+)/', $cycle, $matches)) {
                                $dueDate->addYears((int)$matches[0]);
                            } else {
                                $dueDate->addYear();
                            }
                        } elseif (str_contains($cycle, 'biennially')) {
                            $dueDate->addYears(2);
                        } else {
                            $dueDate->addMonth();
                        }

                        $config = $service->configuration ?? [];
                        if(is_string($config)) {
                            $config = json_decode($config, true) ?? [];
                        }
                        $domainLabel = $config['domain_connection'] ?? ($config['domain'] ?? '-');
                        $ipLabel = $config['ip_address'] ?? 'Menunggu Alokasi';
                    @endphp

                    <tr class="hover:bg-gray-50 transition group">
                        {{-- 1. Nama Layanan --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-lg shrink-0
                                    {{ $service->type == 'vps' ? 'bg-blue-100 text-blue-600' : 
                                      ($service->type == 'hosting' ? 'bg-orange-100 text-orange-600' : 
                                      ($service->type == 'domain' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600')) }}">
                                    
                                    @if($service->type == 'vps') <i class="ri-server-line"></i>
                                    @elseif($service->type == 'domain') <i class="ri-global-line"></i>
                                    @elseif($service->type == 'hosting') <i class="ri-hard-drive-2-line"></i>
                                    @else <i class="ri-apps-line"></i> @endif
                                </div>
                                <div>
                                    <span class="block font-bold text-gray-800">{{ $service->product_name }}</span>
                                    <span class="text-xs text-gray-500 capitalize">{{ $service->type }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- 2. IP / Domain / Lisensi --}}
                        <td class="px-6 py-4">
                            @if($service->type == 'domain')
                                <span class="font-mono text-blue-600 font-semibold">{{ $service->product_name }}</span>
                            @elseif($service->type == 'saas' || $service->type == 'plugin')
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 mb-1">Lisensi:</span>
                                    <span class="font-mono font-medium {{ isset($config['license_key']) ? 'text-blue-600 font-bold' : 'text-yellow-600 italic' }}">
                                        {{ $config['license_key'] ?? 'Menunggu Pemrosesan' }}
                                    </span>
                                </div>
                            @else
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 mb-1">IP:</span>
                                    <span class="font-mono font-medium {{ isset($config['ip_address']) ? 'text-gray-800' : 'text-yellow-600 italic' }}">
                                        {{ $ipLabel }}
                                    </span>
                                    @if($domainLabel != '-')
                                        <span class="text-xs text-gray-400 mt-1">{{ $domainLabel }}</span>
                                    @endif
                                </div>
                            @endif
                        </td>

                        {{-- 3. Siklus Tagihan --}}
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-bold border border-gray-200 capitalize">
                                {{ $service->billing_cycle }}
                            </span>
                            <div class="text-xs text-gray-400 mt-1">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </div>
                        </td>

                        {{-- 4. Jatuh Tempo --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="ri-calendar-event-line"></i>
                                <span>{{ $dueDate->translatedFormat('d M Y') }}</span>
                            </div>
                            @php $daysLeft = now()->diffInDays($dueDate, false); @endphp
                            @if($daysLeft > 0)
                                <span class="text-[10px] text-green-600">({{ ceil($daysLeft) }} hari lagi)</span>
                            @else
                                <span class="text-[10px] text-red-600 font-bold">(Lewat Jatuh Tempo)</span>
                            @endif
                        </td>

                        {{-- 5. Status --}}
                        <td class="px-6 py-4 text-center">
                            @php
                                $status = $service->order->status ?? 'pending';
                                $statusColor = match($status) {
                                    'active', 'paid', 'success' => 'bg-green-100 text-green-700 border-green-200',
                                    'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                    'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                    default => 'bg-gray-100 text-gray-700 border-gray-200'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColor }} capitalize">
                                {{ $status == 'paid' ? 'Active' : $status }}
                            </span>
                        </td>

                        {{-- 6. Aksi --}}
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('client.services.show', $service->id) }}" 
                               class="inline-flex items-center justify-center w-8 h-8 bg-white border border-gray-200 rounded-lg text-blue-600 hover:bg-blue-50 hover:border-blue-300 transition shadow-sm"
                               title="Kelola Layanan">
                                <i class="ri-settings-3-line"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="p-4 border-t border-gray-100 ajax-pagination">
        {{ $services->links() }} 
    </div>

@else
    {{-- TAMPILAN KOSONG (JIKA SERVICES COUNT == 0) --}}
    <div class="flex flex-col items-center justify-center py-16 text-center text-gray-500">
        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
            <i class="ri-inbox-archive-line text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-700">Belum ada layanan</h3>
        <p class="text-sm mt-1 max-w-xs">Layanan yang Anda beli akan muncul di sini setelah pembayaran berhasil.</p>
        <a href="{{ route('catalog') }}" class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition">
            Beli Layanan Baru
        </a>
    </div>
@endif