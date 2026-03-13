<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;

class CheckPostSize
{
    public function handle(Request $request, Closure $next)
    {
        $max = $this->getPostMaxSize();

        if ($request->server('CONTENT_LENGTH') > $max) {
            // Jika AJAX/JSON Request (untuk Cropper nanti)
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Ukuran file terlalu besar! Maksimal upload: ' . ini_get('post_max_size')
                ], 413);
            }

            // Jika Request Form Biasa
            return redirect()->back()->with('error', 'Gagal Upload: Ukuran file terlalu besar! Batas maksimal server adalah ' . ini_get('post_max_size'));
        }

        return $next($request);
    }

    // Helper untuk konversi '8M' jadi bytes
    protected function getPostMaxSize()
    {
        $postMaxSize = ini_get('post_max_size');
        $unit = strtoupper(substr($postMaxSize, -1));
        $size = (int) $postMaxSize;

        switch ($unit) {
            case 'G': $size *= 1024;
            case 'M': $size *= 1024;
            case 'K': $size *= 1024;
        }

        return $size;
    }
}