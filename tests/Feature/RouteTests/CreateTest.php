<?php

namespace Tests\Feature\RouteTests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_account_profile_controller_create()
    {
        $user = User::factory()->create();
        $_GET = ['profile' => 14];
        $response = $this->actingAs($user)->get(route('account.profiles.create', $_GET));
        $response->assertOk();
    }
    public function test_account_users_controller_create()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        // dd($user);
        $response = $this->actingAs($user)->get(route('account.users.create', $_GET));
        $response->assertOk();
    }
    public function test_admin_profiles_controller_create()
    {
        $user = User::factory()->create();
        $_GET = ['user' => 1];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.profiles.create', $_GET));
        $response->assertOk();
    }
    public function test_admin_relation_controller_create()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.relations.create'));
        $response->assertOk();
    }
    public function test_admin_skill_controller_create()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.skills.create'));
        $response->assertOk();
    }
    public function test_admin_tag_controller_create()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.tags.create'));
        $response->assertOk();
    }
    public function test_admin_user_controller_create()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('account.users.create'));
        $response->assertOk();
    }
    public function test_subscription_controller_create()
    {
        $response = $this->get(route('subscriptions.create'));
        $response->assertOk();
    }
        // GET|HEAD        gymReviews/create .................................................. gymReviews.create › GymReviewController@create
        public function test_gymReview_controller_create()
        {
            $user = User::factory()->create();
            $user->status ='ACTIVE';
            $response = $this->actingAs($user)->get(route('gymReviews.create'));
            $response->assertOk();
        }
}
