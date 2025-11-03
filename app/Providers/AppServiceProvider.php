<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        # macro error on response
        Response::macro('error', function ($message, $status = 400, $extra = []) {
            return response()->json([
                'status' => 'error',
                'message' => $message,
                ...$extra,
            ], $status);
        });
    }
}
