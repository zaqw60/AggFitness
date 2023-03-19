<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gym;
use App\Services\Filters\ModeratingFilter;
use App\Http\Controllers\Controller;
use App\Models\Moderating;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModeratingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $userRoles = Role::All('role')->toArray();

        $moderatings = Moderating::with('user');
        $moderatings = (new ModeratingFilter($moderatings, $request))
            ->apply()
            ->paginate(config('pagination.admin.moderatings'));

        return view('admin.moderatings.index', [
            'moderatings' => $moderatings,
            'userRoles' => $userRoles,
            'moderatingStatuses' => Moderating::getArrayStatuses(),
            'userStatuses' => User::getArrayStatuses()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Moderating $moderating
     * @return View
     */
    public function edit(Moderating $moderating): View
    {
        $moderatingList = '';

        $reasons = Moderating::getArrayReasons();

        $role_id = User::whereId($moderating->user_id)->get('role_id')[0]->role_id;

        $roles = Role::all('role')->toArray();

        if ($roles[$role_id - 1]['role'] === 'IS_TRAINER') {
            //тренер (users,profiles,skills,tags),
            $moderatingList = Moderating::query()
                ->whereId($moderating->id)
                ->with('user')
                ->with('profile')
                ->with('skill')
                ->with('tags')
                ->get();
        }

        if ($roles[$role_id - 1]['role'] === 'IS_CLIENT') {
            //клиент (users,profiles,characteristics)
            $moderatingList = Moderating::query()
                ->whereId($moderating->id)
                ->with('user')
                ->with('profile')
                ->with('characteristic')
                ->get();
        }

        if ($roles[$role_id - 1]['role'] === 'IS_GYM') {
            //владелец спортзала (gyms,gym_addresses,gym_images)
            $moderatingList = Moderating::query()
                ->whereId($moderating->id)
                ->with('user')
                ->with('profile')
                ->with('gym', function ($query) {
                    $query->with('addresses');
                    $query->with('images');
                })
                //->with('gymAddresses')
                //->with('gymImages')
                ->get();
        }

        return view('admin.moderatings.read', [
            'moderatingList' => $moderatingList[0],
            'roles' => $roles,
            'reasons' => $reasons
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Moderating $moderating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moderating $moderating)
    {
        $message = '';

        $reasons = Moderating::getArrayReasons();

        switch($request['submit_key']) {
            case 'IS_APPROVED': // нажата кнопка APPROVED
                Moderating::whereId($moderating->id)
                    ->update([
                        'reason' => Moderating::REASON00,
                        'status' => Moderating::IS_APPROVED
                    ]);

                User::whereId($moderating->user_id)
                    ->update([
                        'status' => User::ACTIVE
                    ]);

                $message = __('messages.admin.moderatings.change.success');
                break;
            case 'IS_REJECTED': // нажата кнопка REJECTED
                Moderating::whereId($moderating->id)
                    ->update([
                        'reason' => $reasons[$request['reason']],
                        'status' => Moderating::IS_REJECTED
                    ]);

                User::whereId($moderating->user_id)
                    ->update([
                        'status' => User::BLOCKED
                    ]);

                $message = __('messages.admin.moderatings.change.fail');
                break;
        }

        return back()->with("success", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
