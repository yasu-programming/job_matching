<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_jobseeker_can_register(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'jobseeker',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('jobseeker.dashboard'));
    }

    public function test_new_company_can_register(): void
    {
        $response = $this->post('/register', [
            'first_name' => 'Company',
            'last_name' => 'Admin',
            'email' => 'company@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'company',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('company.dashboard'));
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_jobseeker_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'user_type' => 'jobseeker',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('jobseeker.dashboard'));
    }

    public function test_company_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'user_type' => 'company',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('company.dashboard'));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
