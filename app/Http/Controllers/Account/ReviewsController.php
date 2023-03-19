<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */

    public function showTrainerReviews(): View
    {
        $user = User::query()
            ->with('trainers', 'moderating')
            ->findOrFail(Auth::user()->id);
        return view('account.reviews.reviewsTrainer', [
            'user' => $user,
        ]);
    }

    public function showGymReviews(): View
    {
        $user = User::query()
            ->with('gyms', 'moderating')
            ->findOrFail(Auth::user()->id);
        return view('account.reviews.reviewsGym', [
            'user' => $user,
        ]);
    }
}
