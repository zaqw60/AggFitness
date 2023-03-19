<?php

namespace Tests\Feature;

use App\Models\Gym;
use App\Models\GymAddress;
use App\Models\GymImage;
use App\Models\Moderating;
use App\Models\Profile;
use App\Models\Relation;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class relationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_role_data_from_user()
    {
        $users = User::all();
        foreach ($users as $user) {
            $roles = $user->role()->get();
            foreach($roles as $role){
                $this->assertDatabaseHas('users', [
                    'role_id' => $role->id,
                    'email' => $user->email,
                ]);
            }
        }

    }
    public function test_get_user_data_from_profile()
    {
        $profiles = Profile::all();
        foreach ($profiles as $profile) {
            $users = $profile->user()->get();
            foreach ($users as $user){
                $this->assertDatabaseHas('users', [
                    'id' => $profile->user_id,
                    'email' => $user->email,
                ]);
            }
        }
    }
    public function test_get_user_data_from_gym()
    {
        $gyms = Gym::all();
        foreach ($gyms as $gym) {
            $users = $gym->user()->get();
            foreach ($users as $user){
                $this->assertDatabaseHas('users', [
                    'id' => $gym->user_id,
                    'email' => $user->email,
                ]);
            }
        }
    }
    public function test_get_gymAdreses_data_from_gym()
    {
        $gymsAddress = GymAddress::all();
        foreach ($gymsAddress as $gymAddress) {
            $gyms = $gymAddress->gym()->get();
            foreach ($gyms as $gym){
                $this->assertDatabaseHas('gyms', [
                    'id' => $gymAddress->gym_id,
                    'email' => $gym->email,
                ]);
            }
        }
    }
    public function test_get_gymImages_data_from_gym()
    {
        $gymsImages = GymImage::all();
        foreach ($gymsImages as $gymImage) {
            $gyms = $gymImage->gym()->get();
            foreach ($gyms as $gym){
                $this->assertDatabaseHas('gyms', [
                    'id' => $gymImage->gym_id,
                    'email' => $gym->email,
                ]);
            }
        }
    }
    public function test_get_user_data_from_skills()
    {
        $skills = Skill::all();
        foreach ($skills as $skill) {
            $users = $skill->user()->get();
            foreach ($users as $user){
                $this->assertDatabaseHas('users', [
                    'id' => $skill->user_id,
                    'email' => $user->email,
                ]);
            }
        }
    }
    public function test_get_user_data_from_moderating()
    {
        $moderatings = Moderating::all();
        foreach ($moderatings as $moderating) {
            $users = $moderating->user()->get();
            foreach ($users as $user){
                $this->assertDatabaseHas('users', [
                    'id' => $moderating->user_id,
                    'email' => $user->email,
                ]);
            }
        }
    }

}
