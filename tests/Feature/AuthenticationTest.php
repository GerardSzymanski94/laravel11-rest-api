<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('1qazxsw2'),
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => '1qazxsw2',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(200);

        $this->assertArrayHasKey('token', $response->json());
    }
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('1qazxsw2'),
        ]);

        $invalidCredentials = [
            'email' => $user->email,
            'password' => 'wrong',
        ];

        $response = $this->postJson('/api/login', $invalidCredentials);

        $response->assertStatus(401);
    }
}
