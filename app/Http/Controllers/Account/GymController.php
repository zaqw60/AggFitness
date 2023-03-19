<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gyms\CreateRequest;
use App\Http\Requests\Gyms\EditRequest;
use App\Models\Gym;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GymController extends Controller
{

    public function __construct()
    {
        $this->model = Gym::query();
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
     * @return View
     */
    public function create():View
    {
        return view('account.gyms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        if (Gym::create($request->validated())) {
            return redirect()->route('account')
                ->with('success', __('messages.account.gyms.create.success'));
        }
        return back('error', __('messages.account.gyms.create.fail'));
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
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('account.gyms.edit', [
            'gym' => $this->model
                ->where('user_id', $id)
                ->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Gym $gym
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Gym $gym): RedirectResponse
    {
        if ($gym->fill($request->validated())->save()) {
            $user = $gym->user;
            AccountEvent::dispatch($user);
            return redirect()->route('account')
                ->with('success', __('messages.account.gyms.update.success'));
        }
        return back('error', __('messages.account.gyms.update.fail'));
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
