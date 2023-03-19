<?php

namespace Tests\Feature;

use App\Models\GymReview;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DevTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // GET|HEAD        gym/review/{review_id}/{client_id}/{gym_id}/{city_id} .......................... gyms.review › GymController@review





    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // POST            gymReviews ........................................................... gymReviews.store › GymReviewController@store
    // Не прописан в самом контроллере
    // public function test_gymReviews_controller_store()
    // {
    //     $users = User::take(1)->get();
    //     foreach($users as $user){
    //     $req = [
    //         'tag' => 'Tests',
    //         'created_at' => now('Europe/Moscow')
    //     ];
    //     $response = $this->actingAs($user)->post(route('gymReviews.store'));
    //     $response->assertRedirect(route('admin.tags.index'));}
    // }
    // PUT|PATCH       gymReviews/{gymReview} ............................................. gymReviews.update › GymReviewController@update
    // Не разобрался до конца
    // public function test_gymReviews_controller_update()
    // {
    //     $users = User::take(1)->get();
    //     $gymReviews = GymReview::take(1)->get();
    //     foreach ($gymReviews as $gymReview){
    //        $upd = $gymReview->getAttributes();
    //        $upd['city_id'] =0;
    //        $upd['description']= 'asdgfvafgvasdfasfasfasdf';

    //         foreach($users as $user){
    //             $user->status ='ACTIVE';
    //             $_POST = ['gymReview' => 0,
    //             'client_id' => 0];
    //             // dd($upd);
    //     $response = $this->actingAs($user)->put(route('gymReviews.update', $_POST),$upd);
    //     $response->assertRedirect(route('gyms.show', $upd));}}
    // }

    // DELETE          gymReviews/{gymReview} ........................................... gymReviews.destroy › GymReviewController@destroy
    // Не написан в еонтроллере
    // public function test_gymReviews_controller_destroy(){
    //     $users = User::take(1)->get();
    //     foreach($users as $user){
    //         $_GET = ['gymReview' => $user->id];
    //     $response = $this->actingAs($user)->delete(route('gymReviews.destroy',$_GET));
    //     $response->assertOk();}
    // }
}
