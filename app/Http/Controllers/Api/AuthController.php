<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\CadastroRealizado;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        ['email' => $email, 'password' => $password] = $request->validated();

        if (!$token = Auth::attempt(compact('email', 'password'))) {
            return response()->error('Credenciais inválidas', 401);
        }


        return response()->success(
            new AuthResource([])
        );
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        
        auth()->login($user);

        #CadastroRealizado::dispatch($user);
        CadastroRealizado::dispatch($user)->onQueue('emails');

        return response()->success(
            new AuthResource([])
        );
    }
}
