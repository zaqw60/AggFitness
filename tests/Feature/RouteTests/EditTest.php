<?php

namespace Tests\Feature\RouteTests;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_subscription_controller_edit()
    {
        $_GET = ['subscription' => 14];
        $response = $this->get(route('subscriptions.edit', $_GET));
        $response->assertOk();
    }
    public function test_account_profile_controller_edit()
    {
        $user = User::factory()->create();
        $_GET = ['profile' => 14];
        $response = $this->actingAs($user)->get(route('account.profiles.create', $_GET));
        $response->assertOk();
    }
    public function test_account_users_controller_edit()
    {
        $user = User::factory()->create();
        $_GET = ['user' => 14];
        // $user->role = 'IS_ADMIN';
        $response = $this->actingAs($user)->get(route('account.users.edit', $_GET));
        $response->assertOk();
    }
    public function test_admin_profiles_controller_edit()
    {
        $user = User::factory()->create();
        $faker = Factory::create();
        $profile = Profile::create([
            'user_id' => $user->id,
            'first_name' => $faker->firstNameFemale(),
            'last_name' => $faker->lastName('female'),
            'father_name' => 'Петровна',
            'age' => rand(25, 45),
            'gender' => 'female',
            'image' => 'https://cdn.inskill.ru/media/32540/c/1591358903_o4XapEybYWOG87t8-thumb.jpg?v=1591358908',
            'created_at' => now('Europe/Moscow'),
        ]);

        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.profiles.edit', $profile));
        $response->assertOk();
    }
    public function test_admin_relation_controller_edit()
    {
        $user = User::factory()->create();
        $_GET = ['trainer' => 14];
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.relations.edit', $_GET));
        $response->assertOk();
    }
    public function test_admin_skill_controller_edit()
    {
        $user = User::factory()->create();
        $faker = Factory::create();
        $skill = Skill::create([
            'user_id'         => $user->id,
            'location'        => 'Москва',
            'education'       => $faker->company(),
            'experience'      => rand(1, 20),
            'achievements'    => $faker->paragraph(rand(3, 8)),
            'skills_list'     => $faker->paragraph(rand(6, 10)),
            'description'     => $faker->paragraph(rand(6, 10)),
            'created_at'      => now('Europe/Moscow')
        ]);

        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.skills.edit', $skill));
        $response->assertOk();
    }
    public function test_admin_tag_controller_edit()
    {
        $user = User::factory()->create();
        $tag = Tag::create([
            'tag' => 'Игровые программы',
            'created_at' => now('Europe/Moscow')
        ]);
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('admin.tags.edit', $tag));
        $response->assertOk();
    }
    public function test_admin_user_controller_edit()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $response = $this->actingAs($user)->get(route('account.users.edit', $user));
        $response->assertOk();
    }
        // GET|HEAD        gymReviews/{gymReview}/edit ............................................ gymReviews.edit › GymReviewController@edit
        public function test_gymReviews_controller_edit()
        {
            $users = User::take(1)->get();
            foreach($users as $user){
            $user->status ='ACTIVE';
            $user->role_id = 3;
            $_GET = [
                'gymReview' => 1,
            ];
            $response = $this->actingAs($user)->get(route('gymReviews.edit', $_GET));
            $response->assertOk();}
        }
}
