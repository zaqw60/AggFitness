<?php

namespace Tests\Feature;

use App\Models\Gym;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class dbHasModelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_User_model()
    {
        $user =User::factory()->create();
        $this->assertModelExists($user);
    }

}
