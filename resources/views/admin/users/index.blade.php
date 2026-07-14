@extends('layouts.admin-app')

@section('title', 'Kelola User')
@section('header_title', 'Daftar Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    
    {{-- Top Bar --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h3 class="text-lg font-bold text-gray-800">Total User: {{ $users->total() }}</h3>
        
        <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-80 relative">
            <i class="ri-search-line absolute left-3 top-2.5 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                   placeholder="Cari nama, email, username...">
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 flex items-center gap-2">
            <i class="ri-checkbox-circle-line text-lg"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase font-bold text-xs border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">User Info</th>
                    <th class="px-6 py-4">Kontak</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Bergabung</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition {{ $user->is_banned ? 'bg-red-50' : '' }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ '@' . ($user->username ?? '-') }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-gray-600 mb-1"><i class="ri-mail-line mr-1"></i> {{ $user->email }}</div>
                        <div class="text-gray-500 text-xs"><i class="ri-phone-line mr-1"></i> {{ $user->phone ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($user->is_banned)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                BANNED
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                ACTIVE
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-gray-500 text-xs">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 bg-white border border-gray-200 text-blue-600 rounded-lg hover:bg-blue-50 transition shadow-sm" title="Edit User">
                                <i class="ri-pencil-line"></i>
                            </a>

                            {{-- Ban / Unban --}}
                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" 
                                    class="p-2 border rounded-lg transition shadow-sm {{ $user->is_banned ? 'bg-green-600 text-white border-green-600 hover:bg-green-700' : 'bg-white text-red-600 border-gray-200 hover:bg-red-50' }}"
                                    title="{{ $user->is_banned ? 'Aktifkan Kembali' : 'Ban User' }}"
                                    onclick="event.preventDefault(); const t = event.currentTarget; Swal.fire({title: 'Konfirmasi', text: 'Apakah Anda yakin ingin mengubah status user ini?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#94a3b8', confirmButtonText: 'Ya', cancelButtonText: 'Batal'}).then((r) => { if(r.isConfirmed) { if(t.tagName === 'A') window.location.href = t.href; else { const f = t.closest('form'); if(f) f.submit(); } } })">
                                    <i class="{{ $user->is_banned ? 'ri-user-follow-line' : 'ri-user-forbid-line' }}"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">Data user tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection