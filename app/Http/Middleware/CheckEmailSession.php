<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika session login kustom tidak ada, tendang kembali ke halaman login
        if (!session()->has('email_logged_in') || !session('email_logged_in')) {
            return redirect()->route('webmail.login')->withErrors([
                'email' => 'Silahkan login terlebih dahulu untuk mengakses webmail.'
            ]);
        }

        return $next($request);
    }
}