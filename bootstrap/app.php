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

        $middleware->alias([

            /*
            |--------------------------------------------------------------------------
            | Custom Middleware
            |--------------------------------------------------------------------------
            */

            'partner'      => \App\Http\Middleware\IsPartner::class,
            'admin'        => \Illuminate\Auth\Middleware\Authenticate::class,
            'email.auth'   => \App\Http\Middleware\CheckEmailSession::class,
            'check.banned' => \App\Http\Middleware\CheckBanned::class,
            'post.size'    => \App\Http\Middleware\CheckPostSize::class,

        ]);
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\CheckBanned::class);
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'ipaymu/callback',
            'webhook/plugin/installed',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();