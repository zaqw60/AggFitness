<?php

namespace Tests\Feature\RouteTests;

use App\Models\GymReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_info()
    {
        $response = $this->get('/');
        $response->assertOk();
    }
    public function test_api_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/user');
        $response->assertOk();
    }
    public function test_trainers_controller_index()
    {
        $_GET = [
            'tag_id' => 4,
            'city_id' => 4,
        ];
        $response = $this->get(route('trainers.index', $_GET));
        $response->assertOk();
    }
    public function test_subscription_controller_index()
    {
        $response = $this->get(route('subscriptions.index'));
        $response->assertOk();
    }
    public function test_admin_user_controller_index()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('account.users.index'));
        $response->assertOk();
    }
    public function test_admin_tag_controller_index()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.tags.index'));
        $response->assertOk();
    }
    public function test_admin_skill_controller_index()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.skills.index'));
        $response->assertOk();
    }
    public function test_admin_relation_controller_index()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.relations.index'));
        $response->assertOk();
    }
    public function test_admin_profiles_controller_index()
    {
        $user = User::factory()->create();
        $_GET = ['user' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.profiles.index', $_GET));
        $response->assertOk();
    }
    public function test_admin_controller_index()
    {
        $user = User::factory()->create();
        $_GET = ['user' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.index', $_GET));
        $response->assertOk();
    }
    public function test_account_users_controller_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('account.users.index'));
        $response->assertOk();
    }
    public function test_account_profile_controller_index()
    {
        $user = User::factory()->create();
        $_GET = ['profile' => 14];
        $response = $this->actingAs($user)->get(route('account.profiles.index', $_GET));
        $response->assertOk();
    }
    public function test_account_controller_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('account'));
        $response->assertOk();
    }
    // GET|HEAD        gyms/{city_id} ................................................................... gyms.index › GymController@index
    public function test_gymReviews_controller_index()
    {
        $users = User::take(1)->get();
        foreach($users as $user){
            $user->status ='ACTIVE';
        $_GET = [
            'city_id' => 1,
        ];
        $response = $this->actingAs($user)->get(route('gymReviews.index', $_GET));
        $response->assertOk();}
    }
        // GET|HEAD        gymReviews ........................................................... gymReviews.index › GymReviewController@index
        public function test_gymReview_controller_index()
        {
            $user = User::factory()->create();
            $user->status ='ACTIVE';
            $response = $this->actingAs($user)->get(route('gymReviews.index'));
            $response->assertOk();
        }
        public function test_gym_controller_review()
        {
            $user = User::factory()->create();
            $gymReviews = GymReview::take(1)->get();
            foreach ($gymReviews as $gymReview ){
            $_GET = [
                'review_id' => $gymReview->id,
                'client_id' => $gymReview->client_id,
                'gym_id' => $gymReview->gym_id,
                'city_id' => 1
            ];}
            $response = $this->actingAs($user)->get(route('gyms.review', $_GET));
            $response->assertOk();
        }
}
