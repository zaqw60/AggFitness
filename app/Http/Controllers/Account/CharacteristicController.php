<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Characteristics\CreateRequest;
use App\Http\Requests\Characteristics\EditRequest;
use App\Models\Characteristic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function __construct()
    {
        $this->model = Characteristic::query();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application
     */
    public function create(): View
    {
        return view('account.characteristics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $request = $request->validated();
        $request['user_id'] = Auth::user()->id;

        if (Characteristic::create($request)) {
            return redirect()->route('account')
                ->with('success', __('messages.account.characteristics.create.success'));
        }
        return back('error', __('messages.account.characteristics.create.fail'));
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

        return view('account.characteristics.edit', [
            'characteristic' => $this->model
                ->where('user_id', $id)
                ->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Characteristic $characteristic
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Characteristic $characteristic): RedirectResponse
    {
        if ($characteristic->fill($request->validated())->save()) {
            $user = $characteristic->user;
            AccountEvent::dispatch($user);
            return redirect()->route('account')
                ->with('success', __('messages.account.characteristics.update.success'));
        }
        return back('error', __('messages.account.characteristics.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        //
    }
}
