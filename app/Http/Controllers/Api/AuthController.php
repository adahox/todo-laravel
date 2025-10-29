<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\CadastroRealizado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResource | JsonResponse
    {
        ['email' => $email, 'password' => $password] = $request->validated();

        if (!$token = Auth::attempt(compact('email', 'password'))) {
            return response()->error('Credenciais inválidas', 401);
        }

        return auth()->user()->toResource(AuthResource::class);
    }

    public function register(RegisterRequest $request): JsonResource | JsonResponse
    {
        $user = User::create($request->validated());
       
        auth()->login($user);

        CadastroRealizado::dispatch($user)->onQueue('emails');
        
        return auth()->user()->toResource(AuthResource::class);
    }
}
