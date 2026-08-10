@extends('layouts.admin-app')
@section('title', 'Monitoring Visitor')
@section('header_title', 'Monitoring Visitor')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
<div class="max-w-[100rem] mx-auto w-full" x-data="{ showJourneyModal: false, activeJourney: null }">

    <div class="mb-6 flex flex-col md:flex-row justify-between md:items-end gap-4">
        <div class="flex flex-wrap bg-white shadow-sm border border-slate-200 p-1 rounded-xl w-fit gap-1">
            <a href="{{ route('admin.monitoring', ['filter' => 'today']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $filter == 'today' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">Hari Ini</a>
            <a href="{{ route('admin.monitoring', ['filter' => 'week']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $filter == 'week' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">Minggu Ini</a>
            <a href="{{ route('admin.monitoring', ['filter' => 'month']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $filter == 'month' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">Bulan Ini</a>
            <a href="{{ route('admin.monitoring', ['filter' => 'year']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $filter == 'year' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">Tahun Ini</a>
            <button id="customRangeBtn" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all flex items-center gap-2 {{ $filter == 'custom' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                <i class="ri-calendar-line"></i> Custom Range
            </button>
            <input type="text" id="customRangePicker" class="opacity-0 absolute w-0 h-0" style="bottom: 0;">
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex flex-col justify-center items-center text-center h-full">
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Total Pengunjung</p>
            <h3 class="text-6xl font-black text-slate-900 mb-2">{{ number_format($totalVisitors) }}</h3>
            <p class="text-xs text-blue-600 font-medium bg-blue-50 px-3 py-1 rounded-full">
                Sesi Aktif: {{ $filter == 'today' ? 'Hari ini' : ($filter == 'week' ? 'Minggu ini' : ($filter == 'month' ? 'Bulan ini' : 'Tahun ini')) }}
            </p>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-6 shadow-sm relative h-64">
            <canvas id="trafficChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-8">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Perjalanan Pengunjung (Visitor Journey)</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">IP / Sesi</th>
                        <th class="px-6 py-4 w-[40%]">Alur Singkat</th>
                        <th class="px-6 py-4 whitespace-nowrap">Mulai</th>
                        <th class="px-6 py-4 whitespace-nowrap">Aktivitas Terakhir</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($visitorLogs as $log)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $log->ip_address }}</div>
                            <div class="text-xs text-slate-400 truncate w-24" title="{{ $log->session_id }}">ID: {{ substr($log->session_id, 0, 8) }}...</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap items-center gap-2">
                                @if($log->page_journey && is_array($log->page_journey))
                                    @foreach(array_slice($log->page_journey, 0, 3) as $step)
                                        <div class="flex items-center gap-1 group relative">
                                            <span class="px-2 py-1 bg-slate-100 border border-slate-200 text-slate-700 text-[11px] font-medium rounded shadow-sm truncate max-w-[120px]">
                                                {{ $step['path'] == '/' ? '/ (Home)' : $step['path'] }}
                                            </span>
                                            
                                            @if(!$loop->last || count($log->page_journey) > 3)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                            @endif
                                        </div>
                                    @endforeach
                                    
                                    @if(count($log->page_journey) > 3)
                                        <span class="text-[11px] text-slate-400 font-bold bg-slate-50 border px-2 py-1 rounded">
                                            +{{ count($log->page_journey) - 3 }} lagi
                                        </span>
                                    @endif
                                @else
                                    <span class="text-slate-400 italic text-xs">Belum ada data alur</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 local-time" data-timestamp="{{ $log->created_at->toIso8601String() }}">{{ $log->created_at->format('H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold">{{ $log->updated_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($log->page_journey && count($log->page_journey) > 0)
                                <button @click="activeJourney = {{ json_encode($log->page_journey) }}; showJourneyModal = true" class="text-blue-600 font-bold text-xs bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition-colors whitespace-nowrap">Lihat Full</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada data pengunjung pada rentang waktu ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100 flex overflow-x-auto">
            {{ $visitorLogs->appends(['filter' => $filter])->links() }}
        </div>
    </div>

    <div x-show="showJourneyModal" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div x-show="showJourneyModal" x-transition.opacity class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showJourneyModal = false"></div>
        <div x-show="showJourneyModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 overflow-hidden flex flex-col max-h-[85vh]">
            <div class="flex justify-between items-center mb-5 border-b border-slate-100 pb-4">
                <h3 class="text-xl font-bold text-slate-900">Timeline Pengunjung</h3>
                <button @click="showJourneyModal = false" class="text-slate-400 hover:text-slate-600 bg-slate-100 p-1.5 rounded-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <div class="overflow-y-auto pr-4 pl-2 pb-4 space-y-4" x-if="activeJourney">
                <div class="relative border-l-2 border-blue-100 ml-3 pl-6 py-2 space-y-6">
                    <template x-for="(step, index) in activeJourney" :key="index">
                        <div class="relative">
                            <div class="absolute -left-[33px] top-1.5 w-4 h-4 rounded-full bg-blue-500 border-[3px] border-white shadow-sm"></div>
                            
                            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3.5 shadow-sm">
                                <div class="flex justify-between items-start mb-1.5 gap-2">
                                    <span class="font-bold text-blue-700 text-sm break-all leading-tight" x-text="step.path === '/' ? '/ (Home)' : step.path"></span>
                                    <span class="text-xs font-bold text-slate-500 bg-white border border-slate-200 px-2 py-0.5 rounded-md whitespace-nowrap shadow-sm" x-text="window.formatLocalTime(step.time)"></span>
                                </div>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Langkah ke-<span x-text="index + 1"></span></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);
        const ctx = document.getElementById('trafficChart');
        
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: chartData.labelName,
                        data: chartData.values,
                        borderColor: '#2563eb', // text-blue-600
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563eb',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    });

    window.formatLocalTime = function(timeStr) {
        if(!timeStr) return '';
        var parts = timeStr.split(':');
        if(parts.length < 2) return timeStr;
        var d = new Date();
        d.setUTCHours(parseInt(parts[0], 10), parseInt(parts[1], 10), 0, 0);
        return d.getHours().toString().padStart(2, '0') + ':' + d.getMinutes().toString().padStart(2, '0');
    };

    // Jalankan konversi waktu lokal terpisah agar tidak terganggu jika Chart.js gagal dimuat
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.local-time').forEach(function(el) {
            var timestamp = el.getAttribute('data-timestamp');
            if(timestamp) {
                // Konversi timestamp ISO 8601 (UTC jika berakhiran Z/+00:00) ke zona waktu lokal pengguna
                var date = new Date(timestamp);
                var hours = date.getHours().toString().padStart(2, '0');
                var minutes = date.getMinutes().toString().padStart(2, '0');
                el.innerText = hours + ':' + minutes;
            }
        });
    });
</script>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#customRangePicker", {
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            positionElement: document.getElementById('customRangeBtn'),
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    let start = instance.formatDate(selectedDates[0], "Y-m-d");
                    let end = instance.formatDate(selectedDates[1], "Y-m-d");
                    window.location.href = "{{ route('admin.monitoring') }}?filter=custom&start_date=" + start + "&end_date=" + end;
                }
            }
        });

        document.getElementById('customRangeBtn').addEventListener('click', function() {
            document.getElementById('customRangePicker')._flatpickr.open();
        });
    });
</script>
@endsection