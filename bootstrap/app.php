<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // --- TAMBAHKAN BAGIAN INI ---
        $middleware->alias([
            'partner' => \App\Http\Middleware\IsPartner::class,
            'admin'   => \Illuminate\Auth\Middleware\Authenticate::class, // Opsional jika admin pakai auth bawaan
        ]);
        // ----------------------------

        $middleware->prepend(\App\Http\Middleware\CheckPostSize::class);

    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\CheckBanned::class);
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'ipaymu/callback',
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();