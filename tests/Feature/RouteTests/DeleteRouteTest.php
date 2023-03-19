<?php

namespace Tests\Feature\RotuTests;

use App\Models\Profile;
use App\Models\Relation;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_profiles_controller_destroy(){
        $user = User::factory()->create();
        $user->role_id = 1;
        $deliteObjects = Profile::latest()->take(1)->get();
        foreach ($deliteObjects as $deliteObject) {
            $_GET = ['profile' => $deliteObject->id];
                    }
        $deliteObject->deleted_at = now('Europe/Moscow');
        $response = $this->actingAs($user)->delete(route('admin.profiles.destroy',$_GET,$deliteObject));
        $response->assertOk();
    }

    public function test_admin_relations_controller_destroy(){
        $user = User::factory()->create();
        $user->role_id = 1;
        $deliteObjects = Relation::latest()->take(1)->get();
        foreach ($deliteObjects as $deliteObject) {
            $_GET = ['trainer' => $deliteObject->id];
                    }
        $deliteObject->deleted_at = now('Europe/Moscow');
        $response = $this->actingAs($user)->delete(route('admin.relations.destroy',$_GET,$deliteObject));
        $response->assertOk();
    }

    public function test_admin_skill_controller_destroy(){
        $user = User::factory()->create();
        $user->role_id = 1;
        $deliteObjects = Skill::latest()->take(1)->get();
        foreach ($deliteObjects as $deliteObject) {
            $_GET = ['skill' => $deliteObject->id];
                    }
        $deliteObject->deleted_at = now('Europe/Moscow');
        $response = $this->actingAs($user)->delete(route('admin.skills.destroy',$_GET,$deliteObject));
        $response->assertOk();
    }
    public function test_admin_tag_controller_destroy(){
        $user = User::factory()->create();
        $user->role_id = 1;
        $deliteObjects = Tag::latest()->take(1)->get();
        foreach ($deliteObjects as $deliteObject) {
            $_GET = ['tag' => $deliteObject->id];
                    }
        $deliteObject->deleted_at = now('Europe/Moscow');
        $response = $this->actingAs($user)->delete(route('admin.tags.destroy',$_GET,$deliteObject));
        $response->assertOk();
    }

    public function test_admin_user_controller_destroy(){
        $user = User::factory()->create();
        $user->role_id = 1;
        $deliteObjects = User::latest()->take(1)->get();
        foreach ($deliteObjects as $deliteObject) {
            $_GET = ['user' => $deliteObject->id];
                    }
        $deliteObject->deleted_at = now('Europe/Moscow');
        $response = $this->actingAs($user)->delete(route('admin.users.destroy',$_GET,$deliteObject));
        $response->assertOk();
    }
}

