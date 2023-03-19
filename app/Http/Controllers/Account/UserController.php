<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\EditRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->model = User::query();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Request $request
     * @return RedirectResponse
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
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(int $id): View
    {
        return view('account.users.edit', [
            'user' => $this->model->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(EditRequest $request, User $user): RedirectResponse
    {
        $data = [];
        if (Hash::check($request->validated()['password'], $user->password)) {
            $data = $request->validated();
            if (isset($request->validated()['newPassword'])) {
                $data['password'] = Hash::make($request->validated()['newPassword']);
            } else {
                $data['password'] = Hash::make($request->validated()['password']);
            }
            unset($data['newPassword']);
            if ($user->fill($data)->save()) {
                AccountEvent::dispatch($user);
                return redirect()->route('account')
                    ->with('success', __('messages.account.users.update.success'));
            }
        }
        return back()->with('error', __('messages.account.users.update.fail'));
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
