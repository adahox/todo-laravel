<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authentication_returns_successful_for_correct_credentials()
    {
        $password = 'Testing123!;';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $response = $this->actingAs($user)
            ->post('api/login', [
                'email' => $user->email,
                'password' => $password
            ]);

        $response->assertStatus(200);
    }

        public function test_authentication_returns_error_for_incorrect_credentials()
    {
        $password = 'Testing123!;';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $response = $this->actingAs($user)
            ->post('api/login', [
                'email' => $user->email,
                'password' => 'wrong_password'
            ]);

        $response->assertStatus(401);
    }
}