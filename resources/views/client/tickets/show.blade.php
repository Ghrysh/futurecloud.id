@extends('layouts.client-app')

@section('title', 'Detail Tiket #' . $ticket->id)

@section('header')
<div class="mb-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
    <div>
        <a href="{{ route('client.tickets.index') }}" class="text-sm text-blue-600 hover:underline mb-2 inline-block"><i class="ri-arrow-left-line"></i> Kembali ke Daftar Tiket</a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $ticket->subject }}</h1>
        <p class="text-gray-500 text-sm mt-1">Tiket #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }} &bull; Dibuat {{ $ticket->created_at->format('d M Y, H:i') }}</p>
    </div>
    
    <div class="flex items-center gap-2">
        @if($ticket->status === 'open')
            <span class="px-3 py-1 bg-yellow-50 text-yellow-700 text-sm font-bold rounded-full border border-yellow-200">Status: Open</span>
        @elseif($ticket->status === 'answered')
            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-bold rounded-full border border-blue-200">Status: Answered</span>
        @else
            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm font-bold rounded-full border border-gray-200">Status: Closed</span>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <div class="lg:col-span-2 space-y-6">
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-100 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Ticket Messages History --}}
        <div class="space-y-4">
            @foreach($ticket->messages as $msg)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 {{ $msg->admin_id ? 'border-l-4 border-l-blue-500' : '' }}">
                    <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm {{ $msg->admin_id ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $msg->admin_id ? 'A' : substr($msg->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-sm text-gray-900">{{ $msg->admin_id ? 'Admin / Support Team' : $msg->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $msg->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-wrap">{{ $msg->message }}</div>

                    @if($msg->attachment)
                        <div class="mt-4 pt-3 border-t border-gray-50">
                            <a href="{{ asset('storage/' . $msg->attachment) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline bg-blue-50 px-3 py-1.5 rounded-lg">
                                <i class="ri-attachment-2"></i> Lihat Lampiran
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Reply Form --}}
        @if($ticket->status !== 'closed')
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="ri-reply-line text-blue-600"></i> Balas Tiket
                </h3>
                
                <form action="{{ route('client.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <textarea name="message" required rows="4" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-3 border" placeholder="Ketik balasan Anda di sini..."></textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Lampiran (Opsional)</label>
                        <input type="file" name="attachment" accept="image/jpeg,image/png,application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-1">
                        @error('attachment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow-sm hover:bg-blue-700 transition flex items-center gap-2">
                            Kirim Balasan <i class="ri-send-plane-fill"></i>
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 text-center mt-8">
                <i class="ri-lock-2-line text-3xl text-gray-400 mb-2"></i>
                <p class="text-gray-600 font-medium text-sm">Tiket ini telah ditutup. Anda tidak dapat membalas tiket ini lagi.</p>
            </div>
        @endif

    </div>

    {{-- Ticket Info Sidebar --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
            <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Tiket</h3>
            
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase">Status</p>
                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $ticket->status }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase">Prioritas</p>
                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $ticket->priority }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase">Departemen</p>
                    <p class="text-sm font-medium text-gray-900">Technical Support</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
