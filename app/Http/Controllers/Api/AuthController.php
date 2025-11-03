<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\CadastroRealizado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResource|JsonResponse
    {
        ['email' => $email, 'password' => $password] = $request->validated();

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
        Auth::login($user);
        
        $token = $user->createToken('auth_login', ['*'], now()->addMinutes(30))->plainTextToken;

        return (new AuthResource($user, $token));
    }

    public function register(RegisterRequest $request): JsonResource|JsonResponse
    {
        $user = User::create($request->validated());

        auth()->login($user);

        CadastroRealizado::dispatch($user)->onQueue('emails');

        return auth()->user()->toResource(AuthResource::class);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
