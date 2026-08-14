@extends('layouts.client-app')

@section('title', 'Buat Tiket Baru')

@section('header')
<div class="mb-6">
    <a href="{{ route('client.tickets.index') }}" class="text-sm text-blue-600 hover:underline mb-2 inline-block"><i class="ri-arrow-left-line"></i> Kembali ke Daftar Tiket</a>
    <h1 class="text-2xl font-bold text-gray-900">Buat Tiket Dukungan</h1>
    <p class="text-gray-500 text-sm">Ceritakan kendala Anda agar tim kami dapat membantu.</p>
</div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-3xl">
    <form action="{{ route('client.tickets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Subjek <span class="text-red-500">*</span></label>
                <input type="text" name="subject" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border" placeholder="Contoh: Kendala tidak bisa akses panel VPS">
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat Prioritas <span class="text-red-500">*</span></label>
                <select name="priority" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2.5 border bg-white">
                    <option value="low">Rendah (Pertanyaan Umum)</option>
                    <option value="medium" selected>Sedang (Gangguan Ringan)</option>
                    <option value="high">Tinggi (Sistem Down/Kritis)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pesan <span class="text-red-500">*</span></label>
                <textarea name="message" required rows="6" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-3 border" placeholder="Tuliskan secara detail mengenai pertanyaan atau kendala Anda..."></textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Lampiran (Opsional)</label>
                <input type="file" name="attachment" accept="image/jpeg,image/png,application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-1">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks: 5MB.</p>
                @error('attachment')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="mt-8 pt-6 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow-sm hover:bg-blue-700 transition flex items-center gap-2">
                Kirim Tiket <i class="ri-send-plane-fill"></i>
            </button>
        </div>
    </form>
</div>
@endsection
