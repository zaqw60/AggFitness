<?php

namespace App\Http\Controllers;

use App\Queries\GymQueryBuilder;
use Illuminate\Support\Facades\Auth;

class GymController extends Controller
{
    public function __construct()
    {
        $this->gymBuilder = new GymQueryBuilder;
    }
    public function index(int $city_id)
    {
        if (Auth::user() && Auth::user()->role_id === 3 && $city_id === 0) {
            foreach (config('cities') as $key => $city) {
                if (isset(Auth::user()->characteristic->location) && Auth::user()->characteristic->location === $city) {
                    $city_id = $key;
                }
            }
        }
        return view('gyms.index', [
            'gymsList' => $this->gymBuilder->getWithParamsPaginate(request()->title, $city_id),
            'gymBuilder' => $this->gymBuilder,
            'city_id' => $city_id,
        ]);
    }


    public function show(int $id, int $city_id)
    {
        if ($id === 0) {
            return response('test', 200);
        }
        $arr = $this->gymBuilder->getReviewsPaginate($id);
        if ($arr['gym']->user->status !== 'ACTIVE') {
            abort(404);
        } else {
            return view('gyms.show', [
                'gym' => $arr['gym'],
                'reviewers' => $arr['reviewers'],
                'gymBuilder' => $this->gymBuilder,
                'gym_id' => $id,
                'city_id' => $city_id,
            ]);
        }
    }
    public function review(int $review_id, int $client_id, int $gym_id, int $city_id)
    {
        if ($review_id === 0) {
            return response('test', 200);
        }
        $arr = $this->gymBuilder->getReview($gym_id, $client_id);
        return view('gyms.review', [
            'gym' => $arr['gym'],
            'client' => $arr['client'],
            'gymBuilder' => $this->gymBuilder,
            'city_id' => $city_id,
            'review_id' => $review_id,

        ]);
    }
}
