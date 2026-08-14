@extends('layouts.admin-app')

@section('title', 'Balas Tiket #' . $ticket->id)

@section('header')
<div class="mb-6 flex justify-between items-start">
    <div>
        <a href="{{ route('admin.tickets.index') }}" class="text-sm text-blue-600 hover:underline mb-2 inline-block"><i class="ri-arrow-left-line"></i> Kembali ke Daftar Tiket</a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $ticket->subject }}</h1>
        <p class="text-gray-500 text-sm mt-1">
            Pelanggan: <strong>{{ $ticket->user->name }}</strong> &bull; Tiket #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }} &bull; Dibuat {{ $ticket->created_at->format('d M Y, H:i') }}
        </p>
    </div>
    
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.tickets.status', $ticket->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <select name="status" class="rounded-lg border-gray-300 text-sm font-medium focus:ring-blue-500">
                <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                <option value="answered" {{ $ticket->status === 'answered' ? 'selected' : '' }}>Answered</option>
                <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800">Update Status</button>
        </form>
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
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 {{ $msg->admin_id ? 'border-r-4 border-r-blue-500 bg-blue-50/30' : 'border-l-4 border-l-gray-300' }}">
                    <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm {{ $msg->admin_id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                {{ $msg->admin_id ? 'A' : substr($msg->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-sm text-gray-900">{{ $msg->admin_id ? 'Anda (Admin)' : $msg->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $msg->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="prose prose-sm max-w-none text-gray-800 whitespace-pre-wrap">{{ $msg->message }}</div>

                    @if($msg->attachment)
                        <div class="mt-4 pt-3 border-t border-gray-100">
                            <a href="{{ asset('storage/' . $msg->attachment) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline bg-white border border-blue-100 px-3 py-1.5 rounded-lg shadow-sm">
                                <i class="ri-attachment-2"></i> Lihat Lampiran
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Reply Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="ri-reply-all-line text-blue-600"></i> Kirim Balasan (Sebagai Admin)
            </h3>
            
            <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <textarea name="message" required rows="5" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-3 border" placeholder="Ketik balasan Anda untuk pelanggan..."></textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lampiran Tambahan (Opsional)</label>
                    <input type="file" name="attachment" accept="image/jpeg,image/png,application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-1">
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-sm hover:bg-blue-700 transition flex items-center gap-2">
                        Kirim Balasan & Set 'Answered' <i class="ri-send-plane-fill"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>

    {{-- Ticket Info Sidebar --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
            <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Detail Tiket</h3>
            
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Status Saat Ini</p>
                    @if($ticket->status === 'open')
                        <span class="px-2 py-1 bg-yellow-50 text-yellow-700 text-xs font-bold rounded-md border border-yellow-200">Open</span>
                    @elseif($ticket->status === 'answered')
                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-md border border-blue-200">Answered</span>
                    @else
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-md border border-gray-200">Closed</span>
                    @endif
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Prioritas</p>
                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $ticket->priority }}</p>
                </div>
                <hr class="border-gray-100">
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Informasi Pelanggan</p>
                    <p class="text-sm font-bold text-gray-900">{{ $ticket->user->name }}</p>
                    <p class="text-sm text-gray-600 flex items-center gap-1 mt-1"><i class="ri-mail-line"></i> {{ $ticket->user->email }}</p>
                    <p class="text-sm text-gray-600 flex items-center gap-1 mt-1"><i class="ri-phone-line"></i> {{ $ticket->user->phone ?? 'Tidak ada No HP' }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
