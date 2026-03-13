@extends('layouts.admin-app')

@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard Overview')

@section('content')
    {{-- Statistik Cards --}}
    {{-- Grid disesuaikan: 1 kolom di HP, 2 di Tablet, 3 di Desktop --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        
        {{-- Card 1: Pending --}}
        <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs md:text-sm font-medium uppercase tracking-wider">Pending Approval</p>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mt-1">{{ $stats['pending'] }}</h3>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600 text-lg md:text-xl">
                <i class="ri-time-line"></i>
            </div>
        </div>

        {{-- Card 2: Live --}}
        <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs md:text-sm font-medium uppercase tracking-wider">Live Applications</p>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mt-1">{{ $stats['approved'] }}</h3>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-lg md:text-xl">
                <i class="ri-checkbox-circle-line"></i>
            </div>
        </div>

        {{-- Card 3: Total --}}
        <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between sm:col-span-2 lg:col-span-1">
            <div>
                <p class="text-gray-500 text-xs md:text-sm font-medium uppercase tracking-wider">Total Applications</p>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mt-1">{{ $stats['total'] }}</h3>
            </div>
            <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-lg md:text-xl">
                <i class="ri-apps-line"></i>
            </div>
        </div>
    </div>

    {{-- Recent Pending List --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 md:p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-gray-800 text-sm md:text-base">Perlu Persetujuan Segera</h3>
            <a href="{{ route('admin.saas.index') }}" class="text-xs md:text-sm text-blue-600 hover:underline font-medium">Lihat Semua</a>
        </div>

        {{-- 1. TAMPILAN DESKTOP (TABLE) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3">Aplikasi</th>
                        <th class="px-6 py-3">Partner</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentPending as $app)
                    <tr class="hover:bg-blue-50/30 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $app->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $app->user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $app->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.saas.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs px-3 py-1 bg-blue-50 rounded-lg hover:bg-blue-100 transition">Review</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">Tidak ada aplikasi pending saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 2. TAMPILAN MOBILE (CARD STACK) --}}
        <div class="md:hidden flex flex-col divide-y divide-gray-100">
            @forelse($recentPending as $app)
            <div class="p-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">{{ $app->name }}</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Oleh: {{ $app->user->name }}</p>
                    </div>
                    <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-0.5 rounded">{{ $app->created_at->format('d M') }}</span>
                </div>
                
                <div class="flex justify-end mt-3">
                    <a href="{{ route('admin.saas.index') }}" class="w-full text-center py-2 bg-blue-600 text-white rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm">
                        Review Aplikasi
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-sm text-gray-500">
                <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="ri-check-double-line text-xl"></i>
                </div>
                Tidak ada aplikasi pending.
            </div>
            @endforelse
        </div>

    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Statistik Pengunjung</h3>
        <div class="h-[300px] w-full relative">
            <canvas id="trafficChart"></canvas>
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
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14, 165, 233, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
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
</script>
@endsection