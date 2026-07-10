<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest is redirected to admin login.
     */
    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * Test guest can view login form.
     */
    public function test_guest_can_view_login_form(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
        $response->assertSeeText('Administrator Portal Login');
    }

    /**
     * Test login with invalid credentials shows error.
     */
    public function test_login_with_invalid_credentials_fails(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test non-admin user login fails.
     */
    public function test_non_admin_user_login_fails_and_redirects(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test admin user login succeeds.
     */
    public function test_admin_user_login_succeeds(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test logout clears the session.
     */
    public function test_logout_clears_session(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($user)
            ->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
