<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Jobs\CadastroRealizado;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResource
    {
        ['email' => $email, 'password' => $password] = $request->validated();

        if (!$token = Auth::attempt(compact('email', 'password'))) {
            return response()->error('Credenciais inválidas', 401);
        }

        return new UserResource(auth()->user());
    }

    public function register(RegisterRequest $request): JsonResource
    {
        $user = User::create($request->validated());

        auth()->login($user);

        CadastroRealizado::dispatch($user)->onQueue('emails');

        return new UserResource($user);
    }
}
