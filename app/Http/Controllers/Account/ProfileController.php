<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\CreateRequest;
use App\Http\Requests\Profiles\EditRequest;
use App\Models\Profile;
use App\Services\UploadService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function __construct()
    {
        $this->model = Profile::query();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View|Application
     */
    public function create(): View
    {
        return view('account.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @param UploadService $uploadService
     * @return RedirectResponse
     */
    public function store(CreateRequest $request, UploadService $uploadService): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }
        if (Profile::create($validated)) {
            return redirect()->route('account')
                ->with('success', __('messages.account.profiles.create.success'));
        }
        return back('error', __('messages.account.profiles.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
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
        return view('account.profiles.edit', [
            'profile' => $this->model
                ->where('user_id', $id)
                ->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Profile $profile
     * @param UploadService $uploadService
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Profile $profile, UploadService $uploadService): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }
        if ($profile->fill($validated)->save()) {
            $user = $profile->user;
            AccountEvent::dispatch($user);
            return redirect()->route('account')
                ->with('success', __('messages.account.profiles.update.success'));
        }
        return back('error', __('messages.account.profiles.update.fail'));
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
