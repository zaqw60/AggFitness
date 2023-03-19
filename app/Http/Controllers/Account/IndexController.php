<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Queries\TrainerQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    public function __construct()
    {
        $this->trainerBuilder = new TrainerQueryBuilder;
    }
    public function __invoke(Request $request): View
    {
        $id = Auth::user()->id;
        switch (Auth::user()->role_id) {
            case 1:
                return abort(404);
                break;
            case 2:
                $user = User::query()
                    ->with('profile', 'skill', 'tags', 'clients', 'moderating')
                    ->findOrFail($id);
                $path = 'account.indexTrainer';
                break;
            case 3:
                $user = User::query()
                    ->with('profile', 'characteristic', 'trainers', 'moderating')
                    ->findOrFail($id);
                $path = 'account.indexClient';
                break;
            case 4:
                $user = User::query()
                    ->with('profile', 'gym', 'moderating')
                    ->findOrFail($id);
                $path = 'account.indexGym';
                break;
        }

        return view($path, [
            'user' => $user,
            'trainerBuilder' => $this->trainerBuilder
        ]);
    }
}
