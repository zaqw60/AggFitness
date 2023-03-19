<?php

namespace App\Http\Controllers;

use App\Queries\TrainerQueryBuilder;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->trainerBuilder = new TrainerQueryBuilder;
    }
    public function index(int $tag_id, int $city_id)
    {
        if (Auth::user() && Auth::user()->role_id === 3 && $city_id === 0) {
            foreach (config('cities') as $key => $city) {
                if (isset(Auth::user()->characteristic->location) && Auth::user()->characteristic->location === $city) {
                    $city_id = $key;
                }
            }
        }
        return view('trainers.index', [
            'trainersList' => $this->trainerBuilder->getWithParamsPaginate(request()->firstName, request()->lastName, $city_id, $tag_id),
            'trainerBuilder' => $this->trainerBuilder,
            'tags' => $this->trainerBuilder->getAllTags(),
            'city_id' => $city_id,
            'tag_id' => $tag_id,
        ]);
    }
    /**
     * Нужны два объекта TrainerQueryBuilder,
     * иначе не работает
     */
    public function show(int $id, int $city_id)
    {
        if ($id === 0) {
            return response('test', 200);
        }
        $arr = $this->trainerBuilder->getReviewsPaginate($id);
        return view('trainers.show', [
            'trainer' => $arr['trainer'],
            'reviews' => $arr['reviews'],
            'trainerBuilder' => $this->trainerBuilder,
            'trainer_id' => $id,
            'city_id' => $city_id,
        ]);
    }
    public function review(int $review_id, int $client_id, int $trainer_id, int $city_id)
    {
        if ($review_id === 0) {
            return response('test', 200);
        }
        $arr = $this->trainerBuilder->getReview($trainer_id, $client_id);
        return view('trainers.review', [
            'trainer' => $arr['trainer'],
            'client' => $arr['client'],
            'trainerBuilder' => $this->trainerBuilder,
            'city_id' => $city_id,
            'review_id' => $review_id,

        ]);
    }
}
