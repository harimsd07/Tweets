<?php

namespace App\Providers;


use Illuminate\Support\Facades\Route ;
use Illuminate\Support\ServiceProvider;

class RouteSerrviceProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')->group(base_path('routes/auth.php'));
    }
}
