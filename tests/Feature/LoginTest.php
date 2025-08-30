<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test success user login
     */
    public function test_success_user_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'password'
        ]);

        $response->assertStatus(302); // Redirect to home
    }

    /**
     * Test failed user login with invalid password
     */
    public function test_failed_user_login_with_invalid_password()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'invalid-password'
        ]);

        $response->assertStatus(302); // Redirect back with error message
        $response->assertSessionHasErrors('username');
    }

    /**
     * Test failed user login empty request
     */
    public function test_failed_user_login_empty_request()
    {
        $response = $this->post('/login', [
            'username' => '',
            'password' => ''
        ]);

        $response->assertStatus(302); // Redirect back with error message
        $response->assertSessionHasErrors('username');
        $response->assertSessionHasErrors('password');
    }
}
