<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Profiles\EditRequest;
use App\Http\Requests\Profiles\CreateRequest;
use App\Services\UploadService;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $profiles = Profile::query()->paginate(config('pagination.admin.profiles'));

        return view('admin.profiles.index', [
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();
        $users = User::leftJoin('profiles', function($join) {
                $join->on('users.id', '=', 'profiles.user_id');
            })
            ->whereNull('profiles.user_id')
            ->get(['users.id', 'users.role_id', 'users.name']);

        return view('admin.profiles.create', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @param  UploadService $uploadService
     * @return RedirectResponse
     */
    public function store(CreateRequest $request, UploadService $uploadService): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }

        $profile = new Profile(
            $validated
        );

        if($profile->save()) {
            return redirect()->route('admin.profiles.index')
                ->with('success', __('messages.admin.profiles.create.success'));
        }

        return back()->with('error', __('messages.admin.profiles.create.fail'));
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
     * @param  Profile $profile
     * @return View
     */
    public function edit(Profile $profile): View
    {
        return view('admin.profiles.edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest  $request
     * @param  Profile  $profile
     * @param  UploadService $uploadService
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Profile $profile, UploadService $uploadService): RedirectResponse
    {
        $profile = $profile->fill($request->validated());

        if ($request->hasFile('image')) {
            $profile['image'] = $uploadService->uploadImage($request->file('image'));
        }

        if($profile->save()) {
            return redirect()->route('admin.profiles.index')
                ->with('success',  __('messages.admin.profiles.update.success'));
        }

        return back()->with('error', __('messages.admin.profiles.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     *
     * @return JsonResponse
     */
    public function destroy(Profile $profile): JsonResponse
    {
        try {
            $deleted = $profile->delete();
            if ( $deleted === false) {
                return \response()->json(['status' => 'error'], 400);
            } else {
                return \response()->json(['status' => 'ok']);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage().' '.$e->getCode());
            return \response()->json(['status' => 'error'], 400);
        }
    }
}
