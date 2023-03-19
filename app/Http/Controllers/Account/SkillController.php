<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Skills\CreateRequest;
use App\Http\Requests\Skills\EditRequest;
use App\Models\Skill;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;


class SkillController extends Controller
{
    public function __construct()
    {
        $this->model = Skill::query();
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
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
        return view('account.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        if (Skill::create($request->validated())) {
            return redirect()->route('account')
                ->with('success', __('messages.account.skills.create.success'));
        }
        return back('error', __('messages.account.skills.create.fail'));
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

        return view('account.skills.edit', [
            'skill' => $this->model
                ->where('user_id', $id)
                ->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Skill $skill
     * @return View|Factory|RedirectResponse|Application
     */
    public function update(EditRequest $request, Skill $skill): RedirectResponse
    {
        if ($skill->fill($request->validated())->save()) {
            $user = $skill->user;
            AccountEvent::dispatch($user);
            return redirect()->route('account')
                ->with('success', __('messages.account.skills.update.success'));
        }
        return back('error', __('messages.account.skills.update.fail'));
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
