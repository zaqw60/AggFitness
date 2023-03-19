<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\GymAddress\CreateRequest;
use App\Http\Requests\GymAddress\EditRequest;
use App\Models\GymAddress;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class GymAddressController extends Controller
{
    public function __construct()
    {
        $this->model = GymAddress::query();
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
        return view('account.gym_addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        if (GymAddress::create($request->validated())) {
            return redirect()->route('account')
                ->with('success', __('messages.account.gym_addresses.create.success'));
        }
        return back('error', __('messages.account.gym_addresses.create.fail'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        return view('account.gym_addresses.edit', [
            'gym_address' => $this->model
                ->where('id', $id)
                ->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param GymAddress $gym_address
     * @return RedirectResponse
     */
    public function update(EditRequest $request, GymAddress $gym_address): RedirectResponse
    {
        if ($gym_address->fill($request->validated())->save()) {
            $user = $gym_address->gym->user;
            AccountEvent::dispatch($user);
            return redirect()->route('account')
                ->with('success', __('messages.account.gym_addresses.update.success'));
        }
        return back('error', __('messages.account.gym_addresses.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GymAddress $gym_address
     * @return JsonResponse
     */
    public function destroy(GymAddress $gym_address): JsonResponse
    {
        try {
            $deleted = $gym_address->delete();
            if($deleted === false) {
                return \response()->json('error', 400);
            }

            return \response()->json('ok');

        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return \response()->json('error', 400);
        }
    }
}
