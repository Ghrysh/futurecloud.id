@extends('layouts.client-app')

@section('title', 'Request Migrasi')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="ri-upload-cloud-2-line text-blue-600"></i> Pindah Hosting (Migrasi)
            </h2>
            <p class="text-sm text-gray-500 mt-1">Pindahkan website dari provider lama (Exabytes, dll) ke FutureCloud secara Gratis.</p>
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
                    <i class="ri-checkbox-circle-line mr-1"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('client.migration.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Domain</label>
                    <input type="text" name="old_domain" placeholder="contoh: tokosaya.com" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Username cPanel Lama</label>
                        <input type="text" name="old_username" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password cPanel Lama</label>
                        <input type="password" name="old_password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Provider Asal</label>
                    <select name="old_provider" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="Exabytes">Exabytes</option>
                        <option value="Niagahoster">Niagahoster</option>
                        <option value="Rumahweb">Rumahweb</option>
                        <option value="Other">Lainnya</option>
                    </select>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-sm text-yellow-800">
                    <i class="ri-information-line mr-1"></i> Kami menjamin kerahasiaan data login Anda. Password hanya digunakan sekali untuk proses transfer data.
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                    Mulai Proses Migrasi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection