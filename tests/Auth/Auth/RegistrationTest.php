<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $facker = Factory::create();
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => $facker->email(),
            'phone' => '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99),
            'role_id'        => 2,
            'password' => '11111111',
            'password_confirmation' => '11111111',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('account'));
    }
}
