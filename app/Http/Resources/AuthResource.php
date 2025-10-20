<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public $collects = null;

    public function toArray($request = []): array
    {
        return [
            'status' => 'success',
            'message' => '',
            'user' => new UserResource(auth()->user()),
            'authorization' => [
                'token' => auth()->tokenById(auth()->user()->id),
                'type' => 'bearer',
            ]
        ];
    }
}
