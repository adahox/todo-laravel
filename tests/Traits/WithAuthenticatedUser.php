<?php

namespace Tests\Traits;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

trait WithAuthenticatedUser
{

    protected $authenticatedUser;
    protected $password = 'password';

    public function authenticate()
    {

        $this->authenticatedUser = User::factory()->hasTodo(1)->create([
            'password' => $this->password
        ]);

        Sanctum::actingAs($this->authenticatedUser, abilities: ['*']);
    }
}