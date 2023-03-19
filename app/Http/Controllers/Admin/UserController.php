<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\EditRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $recycledUserCount = User::onlyTrashed()->count();
        $users = User::query()
            ->with(['profile', 'role'])
            ->when($request->has('trashed'), function ($query) {
                $query->onlyTrashed();
            })
            ->get();
            //->paginate(config('pagination.admin.users'));

        return view('admin.users.index', [
            'users' => $users,
            'recycled' => $recycledUserCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $user = new User(
            array_merge(
                $request->validated(),
                ['password' => Hash::make($request['password'])]
            )
        );

        //        $profile = new Profile();
        //
        //        $profile->last_name = $request->input('last_name');
        //        $profile->user_id = $user->id;
        //
        //        $user->profile()->save($profile);

        if ($user->save()) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.create.success'));
        }

        return back()->with('error', __('messages.admin.users.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest $request
     * @param  User $user
     * @return RedirectResponse
     */
    public function update(Request $requestRole, EditRequest $request, User $user): RedirectResponse
    {
        $user = $user->fill(array_merge(
            $request->validated(),
            [
                'password' => $user->password,
                'role_id' => $requestRole->input('role_id'),
            ]
        ));

        if ($user->save()) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.update.success'));
        }

        return back()->with('error', __('messages.admin.users.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $deleted = false;

            if ($user->id != Auth::id()) {
                $deleted = $user->delete();
                $recycledUserCount = User::onlyTrashed()->count();
            } else {
                return \response()->json([
                    'success' => false,
                    'message' => __('messages.admin.users.destroy.current')
                ], 400);
            }

            if ($deleted === false) {
                return \response()->json(['status' => 'error'], 400);
            } else {
                return \response()->json([
                    'success' => true,
                    'message' => __('messages.admin.users.destroy.recycle'),
                    'recycled' => $recycledUserCount
                ], 200);
            }

        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getCode());
            return \response()->json(['status' => 'error'], 400);
        }
    }

    /**
     * Restore User by Id.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $restore = $user->restore();

        if ($restore === false) {
            return redirect()->route('admin.users.index', ['trashed'])
                ->with('error', __('messages.admin.users.restore.fail'));
        } else {
            return redirect()->route('admin.users.index', ['trashed'])
                ->with('success', __('messages.admin.users.restore.success'));
        }
    }

    /**
     * Force delete User by Id.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function forceDelete($id): RedirectResponse
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);
            $deleted = $user->forceDelete();

            if ($deleted === false) {
                return redirect()->route('admin.users.index', ['trashed'])
                    ->with('error', __('messages.admin.users.destroy.fail'));
            } else {
                return redirect()->route('admin.users.index', ['trashed'])
                    ->with('success', __('messages.admin.users.destroy.success'));
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getCode());
            return redirect()->route('admin.users.index', ['trashed'])
                ->with('error', __('messages.admin.users.destroy.fail'));
        }
    }
}
