<?php

namespace Tests\Traits;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

trait WithGuestUser
{
    protected $guest;

    public function authenticate()
    {
        $this->guest = auth('sanctum')->user();
    }
}