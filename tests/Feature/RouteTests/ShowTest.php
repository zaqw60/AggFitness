<?php

namespace Tests\Feature\RouteTests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_account_users_controller_show()
    {
        $user = User::factory()->create();
        $_GET = ['user' => 14];
        $response = $this->actingAs($user)->get(route('account.users.show', $_GET));
        $response->assertOk();
    }

    public function test_admin_profiles_controller_show()
    {
        $user = User::factory()->create();
        $_GET = ['profile' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.profiles.show', $_GET));
        $response->assertOk();
    }

    public function test_admin_relation_controller_show()
    {
        $user = User::factory()->create();
        $_GET = ['profile' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.relations.create', $_GET));
        $response->assertOk();
    }

    public function test_admin_skill_controller_show()
    {
        $user = User::factory()->create();
        $_GET = ['skill' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.skills.show', $_GET));
        $response->assertOk();
    }

    public function test_admin_tag_controller_show()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $_GET = ['tag' => 14];
        $response = $this->actingAs($user)->get(route('admin.tags.show', $_GET));
        $response->assertOk();
    }

    public function test_admin_user_controller_show()
    {
        $user = User::factory()->create();
        $_GET = ['user' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('account.users.show', $_GET));
        $response->assertOk();
    }

    public function test_subscription_controller_show()
    {
        $_GET = ['subscription' => 14];
        $response = $this->get(route('subscriptions.show', $_GET));
        $response->assertOk();
    }

    public function test_trainers_controller_show()
    {
        $_GET = [
            'id' => 0,
            'city_id' => 0,
        ];
        $response = $this->get(route('trainers.show', $_GET));
        $response->assertOk();
    }
        // GET|HEAD        gymReviews/{gymReview} ................................................. gymReviews.show › GymReviewController@show
        public function test_gymReviews_controller_show()
        {
            $user = User::factory()->create();
            $user->status ='ACTIVE';
            $_GET = [
                'gymReview' => 1,
            ];
            $response = $this->actingAs($user)->get(route('gymReviews.show', $_GET));
            $response->assertOk();
        }
            // GET|HEAD        gym/{id}/{city_id} ................................................................. gyms.show › GymController@show
    public function test_gym_controller_show()
    {
        $user = User::factory()->create();
        $_GET = [
            'id' => 5,
            'city_id' => 1
        ];
        $response = $this->actingAs($user)->get(route('gyms.show', $_GET));
        $response->assertOk();
    }
}
