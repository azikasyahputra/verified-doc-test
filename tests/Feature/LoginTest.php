<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_login_valid(): void
    {
        $user = User::factory()->create();

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_login_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_login_invalid_email(): void
    {
        $response = $this->post('api/login', [
            'email' => 'testing@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_login_invalid(): void
    {
        $response = $this->post('api/login', [
            'email' => 'testing@gmail.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_login_invalid_empty(): void
    {
        $response = $this->post('api/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(422);
    }
}
