@extends('layouts.admin-app')

@section('title', 'Kelola Support Tickets')

@section('header')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Support Tickets</h1>
</div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 border-b border-emerald-100 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Tiket ID</th>
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Subjek</th>
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Prioritas</th>
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Pembaruan</th>
                    <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-sm font-mono text-gray-500">
                            #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-sm font-bold text-gray-900">{{ $ticket->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $ticket->user->email }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-sm font-bold text-gray-900">{{ $ticket->subject }}</p>
                        </td>
                        <td class="py-4 px-6">
                            @if($ticket->status === 'open')
                                <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 text-xs font-bold rounded-full border border-yellow-200">Open</span>
                            @elseif($ticket->status === 'answered')
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full border border-blue-200">Answered</span>
                            @else
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full border border-gray-200">Closed</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($ticket->priority === 'high')
                                <span class="text-red-600 font-bold text-xs">Tinggi</span>
                            @elseif($ticket->priority === 'medium')
                                <span class="text-orange-500 font-bold text-xs">Sedang</span>
                            @else
                                <span class="text-blue-500 font-bold text-xs">Rendah</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-sm text-gray-500">
                            {{ $ticket->updated_at->diffForHumans() }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="inline-flex items-center justify-center p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Balas Tiket">
                                <i class="ri-reply-line"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-500">
                            Belum ada tiket dukungan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
