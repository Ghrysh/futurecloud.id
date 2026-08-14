<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!str_contains(request()->getHost(), 'localhost') && !str_contains(request()->getHost(), '127.0.0.1')) {
            URL::forceScheme('https');
        }

        Password::defaults(function () {
            return Password::min(8)
                           ->letters()
                           ->mixedCase()
                           ->numbers()
                           ->symbols();
        });
    }
}