<?php

namespace Tests\Feature\RouteTests;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PutPatchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // // PUT|PATCH       account/profiles/{profile} account.profiles.update › Accoun…
    // public function test_account_profiles_controller_update(){
    //     $user = User::factory()->create();
    //     // $user->role = 'IS_ADMIN';
    //     $deliteObjects = Profile::latest()->take(1)->get();
    //     foreach ($deliteObjects as $deliteObject) {
    //         $_POST = ['profile' => $deliteObject->id,
    //         'user_id' => 1,
    //         'first_name' => 'Admin',
    //         'last_name' => 'Admins',
    //         'father_name' => 'Admin',
    //         'age' => 99,
    //         'gender' => 'male',
    //         'image' => UploadedFile::fake()->create('222222.jpg')];
    //         $deliteObject->first_name = '111111';
    //         // dd($deliteObject);
    //                 }
    //     // $deliteObject->deleted_at = now('Europe/Moscow');
    //     $response = $this->actingAs($user)->put(route('account.profiles.update',$_POST));
    //     // dd($response);
    //     $response->assertRedirect('account/profiles');
    // }
    // PUT|PATCH       account/users/{user} account.users.update › Account\UserCon…
    public function test_account_users_controller_update()
    {
        $user = User::factory()->create();
        $facker = Factory::create();
        $updateObjects = Profile::take(1)->get();
        foreach ($updateObjects as $updateObject) {
            $_POST = [
                'user' => $updateObject->id,
                'name'        => 'admin',
                'email'       => $facker->email,
                'phone'       => '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99),
                'role_id'        => 1,
                'status'      => User::ACTIVE,
                'password'    => 12345678,
                // 'email_verified_at' => now('Europe/Moscow'),
                // 'created_at'  => now('Europe/Moscow')
            ];
            $updateObject->phone = '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99);;
        }
        $response = $this->actingAs($user)->put(route('account.users.update', $_POST));
        $response->assertRedirect(route('account'));
    }
    // // PUT|PATCH       admin/profiles/{profile} admin.profiles.update › Admin\Prof…
    //     public function test_admin_profiles_controller_update(){
    //     $user = User::factory()->create();
    //     // $user->role = 'IS_ADMIN';
    //     $deliteObjects = Profile::latest()->take(1)->get();
    //     foreach ($deliteObjects as $deliteObject) {
    //         $_POST = ['profile' => $deliteObject->id,
    //         'user_id' => 1,
    //         'first_name' => 'Admin',
    //         'last_name' => 'Admins',
    //         'father_name' => 'Admin',
    //         'age' => 99,
    //         'gender' => 'male',
    //         'image' => UploadedFile::fake()->create('222222.jpg')];
    //         $deliteObject->first_name = '111111';
    //         // dd($deliteObject);
    //                 }
    //     // $deliteObject->deleted_at = now('Europe/Moscow');
    //     $response = $this->actingAs($user)->put(route('account.profiles.update',$_POST));
    //     // dd($response);
    //     $response->assertRedirect('account/profiles');
    // }
    //  Тест работает но мне кажется что в контроллере надо что то допиливать @Veedok
    public function test_admin_relations_controller_update()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $deliteObjects = Profile::latest()->take(1)->get();
        foreach ($deliteObjects as $deliteObject) {
            $_POST = ['trainer' => $deliteObject->id];
            $deliteObject->first_name = '111111';
        }
        $response = $this->actingAs($user)->put(route('admin.relations.update', $_POST));
        $response->assertRedirect(route('admin.relations.index'));
    }
    //  PUT|PATCH       admin/skills/{skill} ........................ admin.skills.update › Admin\SkillController@update
    public function test_admin_skills_controller_update()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $faker = Factory::create();
        $updateObjects = Skill::latest()->take(1)->get();
        foreach ($updateObjects as $updateObject) {
            $_POST = [
                'skill' => $updateObject->id,
                'user_id'         =>  $updateObject->user_id,
                'location'        => 'NewCyties',
                'education'       => $faker->company(),
                'experience'      => rand(1, 20),
                'achievements'    => $faker->paragraph(rand(3, 8)),
                'skills_list'     => $faker->paragraph(rand(6, 10)),
                'description'     => $faker->paragraph(rand(6, 10)),
                'created_at'      => now('Europe/Moscow')
            ];
        }
        $response = $this->actingAs($user)->put(route('admin.skills.update', $_POST));
        $response->assertRedirect(route('admin.skills.index'));
    }
    //  PUT|PATCH       admin/tags/{tag} ................................ admin.tags.update › Admin\TagController@update
    public function test_admin_tags_controller_update()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $updateObjects = Tag::latest()->take(1)->get();
        foreach ($updateObjects as $updateObject) {
            $_POST = ['tag' => $updateObject->id];
            $myTag = ['tag' => $updateObject->tag . '1213123'];
        }
        $response = $this->actingAs($user)->put(route('admin.tags.update', $_POST), $myTag);
        $response->assertRedirect(route('admin.tags.index'));
    }
    //   PUT|PATCH       admin/users/{user} ............................ admin.users.update › Admin\UserController@update
    public function test_admin_users_controller_update()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $updateObjects = User::latest()->take(1)->get();
        foreach ($updateObjects as $updateObject) {
            $_POST = ['user' => $updateObject->id];
            $updateObject->phone = '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99);;
            $updateObject->password = 11111111;
            $myTag = $updateObject->getAttributes();
        }
        $response = $this->actingAs($user)->put(route('admin.users.update', $_POST), $myTag);
        $response->assertRedirect(route('admin.users.index'));
    }
}
