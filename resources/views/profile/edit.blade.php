@extends('layouts.landing')

@section('title', 'Account Settings')

@section('styles')
    {{-- Memuat Remix Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* CSS Khusus untuk menimpa style bawaan */
        
        /* Input Fields Normal */
        input[type="text"] {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            width: 100%;
            font-size: 0.95rem;
            transition: all 0.2s;
            background-color: #ffffff;
        }

        input[type="text"]:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        /* Input Read-Only (Untuk Email) */
        input[readonly] {
            background-color: #f3f4f6; /* Abu-abu muda */
            border-color: #e5e7eb;
            color: #6b7280; /* Text abu-abu tua */
            cursor: not-allowed;
        }

        /* Labels */
        label {
            font-weight: 500;
            color: #374151;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Buttons (Save/Update) */
        .btn-primary {
            background-color: #2563eb;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
@endsection

@section('content')
    <div class="w-full bg-gray-50 pt-28 pb-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- HEADER TITLE SECTION -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Settings</h2>
                    <p class="text-gray-500 mt-1">Manage your profile information.</p>
                </div>
                
                <div class="text-sm text-gray-500">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-800 font-medium">Profile</span>
                </div>
            </div>

            <!-- 1. PROFILE OVERVIEW CARD (INFO UTAMA) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
                <!-- Dekorasi Background -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
                
                <!-- Avatar -->
                <div class="relative shrink-0">
                    <img class="h-28 w-28 rounded-full object-cover border-4 border-white shadow-lg bg-gray-100" 
                         src="{{ Auth::user()->profile_photo_url }}" 
                         alt="{{ Auth::user()->name }}">
                    
                    {{-- Indikator Login --}}
                    <div class="absolute bottom-1 right-1 bg-white rounded-full p-1.5 shadow-md border border-gray-100" title="Account Status">
                        @if(Auth::user()->google_id)
                            <i class="ri-google-fill text-blue-600 text-xl"></i>
                        @else
                            <i class="ri-mail-check-fill text-gray-500 text-xl"></i>
                        @endif
                    </div>
                </div>

                <!-- User Info -->
                <div class="text-center md:text-left flex-1 z-10">
                    <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-500 font-medium text-base mb-4">{{ Auth::user()->email }}</p>
                    
                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                            <i class="ri-user-star-line mr-1"></i> Member
                        </span>
                        
                        @if(Auth::user()->email_verified_at)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                <i class="ri-verified-badge-line mr-1"></i> Verified
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                <i class="ri-error-warning-line mr-1"></i> Unverified
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- GRID LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- KOLOM KIRI (2/3 Lebar): Edit Profile Form -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- 2. EDIT PROFILE FORM (MODIFIED: Username, First & Last Name) -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 md:p-8 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"></path>
                                    </svg>
                                </div>
                                Profile Information
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 ml-10">Update your account's profile information.</p>
                        </div>
                        
                        <div class="p-6 md:p-8">
                            {{-- FORM UPDATE DATA --}}
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')

                                <!-- Username -->
                                <div>
                                    <label for="username">Username</label>
                                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required />
                                    @error('username')
                                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Grid Nama Depan & Belakang -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- First Name -->
                                    <div>
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" name="first_name" type="text" value="{{ old('first_name', $user->first_name) }}" required />
                                        @error('first_name')
                                            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div>
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" name="last_name" type="text" value="{{ old('last_name', $user->last_name) }}" required />
                                        @error('last_name')
                                            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email (READ ONLY - Tidak bisa diedit) -->
                                <div>
                                    <label for="email">Email Address <span class="text-xs text-gray-400 font-normal ml-1">(Cannot be changed)</span></label>
                                    <input id="email" name="email" type="text" value="{{ old('email', $user->email) }}" readonly />
                                    <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                        <i class="ri-lock-line"></i> Email terkunci untuk keamanan akun.
                                    </p>
                                </div>

                                <!-- Tombol Save -->
                                <div class="flex items-center gap-4 pt-2">
                                    <button type="submit" class="btn-primary">
                                        Save Changes
                                    </button>

                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium flex items-center gap-1">
                                            <i class="ri-checkbox-circle-line"></i> Saved.
                                        </p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- 3. CONNECTED ACCOUNTS (Google Only) -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M13.0607 7.0001L14.4749 5.58589C16.818 3.24273 20.617 3.24273 22.9602 5.58589C25.3033 7.92904 25.3033 11.728 22.9602 14.0712L21.5459 15.4854L19.4246 13.3641L20.8388 11.9498C21.6199 11.1688 21.6199 9.90246 20.8388 9.12141C20.0578 8.34036 18.7915 8.34036 18.0104 9.12141L15.8891 11.2427L13.0607 8.41431V7.0001ZM10.9393 17.0001L9.52513 18.4143C7.18198 20.7575 3.38299 20.7575 1.03984 18.4143C-1.3033 16.0712 -1.3033 12.2722 1.03984 9.92904L2.45406 8.51483L4.57538 10.6361L3.16117 12.0504C2.38012 12.8314 2.38012 14.0977 3.16117 14.8788C3.94221 15.6598 5.20854 15.6598 5.98959 14.8788L8.11091 12.7575L10.9393 15.5859V17.0001ZM6.6967 15.1717L15.182 6.68641L17.3033 8.80773L8.81802 17.293L6.6967 15.1717Z"></path>
                                    </svg>
                                </div>
                                Connected Accounts
                            </h3>
                        </div>

                        <div class="p-6 md:p-8">
                            <!-- Google Status -->
                            <div class="flex items-center justify-between p-4 rounded-xl border {{ Auth::user()->google_id ? 'bg-blue-50/50 border-blue-200' : 'bg-gray-50 border-gray-200' }}">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100">
                                        <i class="ri-google-fill text-2xl {{ Auth::user()->google_id ? 'text-blue-600' : 'text-gray-400' }}"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">Google</p>
                                        <p class="text-xs text-gray-500">
                                            {{ Auth::user()->google_id ? 'Connected to ' . Auth::user()->email : 'Not connected' }}
                                        </p>
                                    </div>
                                </div>
                                @if(Auth::user()->google_id)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <a href="{{ route('social.redirect', 'google') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                                        Connect
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN (1/3 Lebar): Delete Account Only -->
                <div class="space-y-8">
                    
                    <!-- 4. DELETE ACCOUNT -->
                    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                        <div class="p-6 border-b border-red-50 bg-red-50/30">
                            <h3 class="text-lg font-bold text-red-700 flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path d="M12.866 3L22 19.2H4L12.866 3ZM11 16V18H13V16H11ZM11 10V14H13V10H11Z"></path>
                                    </svg>
                                </div>
                                Delete Account
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">
                                Once your account is deleted, all of its resources and data will be permanently deleted.
                            </p>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection