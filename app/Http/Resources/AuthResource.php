<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $token = $request->user()->createToken( 'auth_login', ['*'], now()->addMinutes(30) );

        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            'authorization' =>  [
                'token' => $token->plainTextToken,
                'expiration' => $token->accessToken->expires_at,
            ]
        ];
    }
}
