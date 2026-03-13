<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <--- 1. WAJIB IMPORT INI

class IsPartner
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 2. Ubah auth()->check() menjadi Auth::check()
        // 3. Tambahkan pengecekan apakah user ada datanya
        
        if (Auth::check() && Auth::user()->role === 'partner') {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Anda bukan Partner.');
    }
}