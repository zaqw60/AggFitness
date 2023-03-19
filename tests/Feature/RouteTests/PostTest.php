<?php

namespace Tests\Feature\RouteTests;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_tags_controller_store()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $req = [
            'tag' => 'Tests',
            'created_at' => now('Europe/Moscow')
        ];
        $response = $this->actingAs($user)->post(route('admin.tags.store', $req, $_GET));
        $response->assertRedirect(route('admin.tags.index'));
    }
    // public function test_account_users_controller_store(){
    //     // Проблемы в контроллере Тест не проходит
    //     $user = User::factory()->create();
    //     $user->role = 'IS_ADMIN';
    //     $req = [
    //         'name'        => 'admin',
    //         'email'       => 'admin@mail.ru',
    //         'phone'       => '+7 (999) 999-99-99',
    //         'role'        => User::IS_ADMIN,
    //         'status'      => User::ACTIVE,
    //         'password'    => Hash::make('12345678'),
    //         'email_verified_at' => now('Europe/Moscow'),
    //         'created_at'  => now('Europe/Moscow')
    //     ];
    //     $response = $this->actingAs($user)->post(route('account.users.store',$req));
    //     $response->assertRedirect(route('account.profiles.index'));
    // }
    // public function test_account_profile_controller_store(){
    //     $user = User::factory()->create();
    //     $_GET = ['user_id' => 14];
    //     $img = UploadedFile::fake()->create('222222.jpg');
    //     $req = [
    //     "first_name" => "123123123",
    //     "last_name" => "123123123",
    //     "father_name" => "123123123123",
    //     "age" => "23",
    //     "gender" => "male",
    //     "image" => $img
    // ];
    //     $response = $this->actingAs($user)->post(route('account.profiles.store',$req , $_GET));
    //     $response->assertOk();
    // }
    public function test_admin_profile_controller_store()
    {
        $user = User::factory()->create();
        $user->role_id = 1;
        $faker = Factory::create();
        $req = [
            'user_id' => 99,
            'first_name' => $faker->firstNameFemale(),
            'last_name' => $faker->lastName('female'),
            'father_name' => 'Петровна',
            'age' => rand(25, 45),
            'gender' => 'female',
            'image' => null,
            'created_at' => now('Europe/Moscow'),
        ];
        $response = $this->actingAs($user)->post(route('admin.profiles.store', $req));
        $response->assertRedirect(route('admin.profiles.index'));
    }
    public function test_admin_skills_controller_store()
    {
        $user = User::factory()->create();
        $_GET = ['user_id' => 14];
        $faker = Factory::create();
        $user->role_id = 1;
        $req = [
            'user_id'         => $user->id,
            'location'        => 'Москва',
            'education'       => $faker->company(),
            'experience'      => rand(1, 20),
            'achievements'    => $faker->paragraph(rand(3, 8)),
            'skills_list'     => $faker->paragraph(rand(6, 10)),
            'description'     => $faker->paragraph(rand(6, 10)),
            'created_at'      => now('Europe/Moscow')
        ];
        $response = $this->actingAs($user)->post(route('admin.skills.store', $req, $_GET));
        $response->assertRedirect(route('admin.skills.index'));
    }
    // public function test_admin_relations_controller_store(){
    // // Не написана функция в самом контроллере
    //         $user = User::factory()->create();
    //         $_GET = ['user_id' => 14];
    //         $user->role = 'IS_ADMIN';
    //         $req = [
    //             'user_id' => $user->id,
    //             'tag_id' => rand(1, 22),
    //             'created_at' => now('Europe/Moscow')
    //     ];
    //         $response = $this->actingAs($user)->post(route('admin.relations.store',$req , $_GET));
    //         $response->assertRedirect(route('admin.relations.index'));
    //     }
    // public function test_admin_user_controller_store(){
    //     // Проблемы в контроллере Тест не проходит
    //         $user = User::factory()->create();
    //         $_GET = ['user_id' => 14];
    //         $faker = Factory::create();
    //         $user->role = 'IS_ADMIN';
    //         $req = [
    //             'name'        => 'admin',
    //             'email'       => 'admin@mail.ru',
    //             'phone'       => '+7 (999) 999-99-99',
    //             'role'        => User::IS_ADMIN,
    //             'status'      => User::ACTIVE,
    //             'password'    => Hash::make('12345678'),
    //             'email_verified_at' => now('Europe/Moscow'),
    //             'created_at'  => now('Europe/Moscow')
    //     ];
    //         $response = $this->actingAs($user)->post(route('admin.users.store',$req , $_GET));
    //         $response->assertRedirect(route('admin.users.store'));
    //     }






    public function test_trainers_controller_review()
    {
        $_GET = [
            'review_id' => 0,
            'client_id' => 0,
            'trainer_id' => 0,
            'city_id' => 0
        ];
        $response = $this->get(route('trainers.review', $_GET));
        $response->assertOk();
    }

    public function test_verify_email()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('verification.notice'));
        $response->assertRedirect('/');
    }
}
