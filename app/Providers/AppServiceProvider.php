<?php

namespace App\Providers;

use App\Http\Responses\UserLoginSuccessfully;
use App\Http\Responses\UserRegisteredSuccessfully;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Support\Arrayable;

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
        Response::macro('success', function ($payload = [], $status = 200) {
            // Se for uma classe de resposta customizada
            if (is_string($payload) && class_exists($payload)) {
                $instance = app($payload);
                return $instance instanceof Arrayable
                    ? response()->json($instance->toArray(), $status)
                    : response()->json(['status' => 'success'], $status);
            }

            // Se for uma instância já criada
            if (is_object($payload) && method_exists($payload, 'toArray')) {
                return response()->json($payload->toArray(), $status);
            }

            // Caso padrão
            return response()->json([
                'status' => 'success',
                'data' => $payload,
            ], $status);
        });

        Response::macro('error', function ($message, $status = 400, $extra = []) {
            return response()->json([
                'status' => 'error',
                'message' => $message,
                ...$extra, // permite adicionar mais campos, se quiser
            ], $status);
        });
    }
}
