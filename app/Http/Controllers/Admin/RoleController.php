<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\EditRequest;
use App\Http\Requests\Roles\CreateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $role = new Role($request->validated());

        if ($role->save()) {
            return redirect()->route('admin.roles.index')
                ->with('success', __('messages.admin.roles.create.success'));
        }

        return back()->with('error', __('messages.admin.roles.create.fail'));
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
     * @param  Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        return view('admin.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest  $request
     * @param  Role $role
     * @return RedirectResponse
     */
    public function update(Request $requestRole, EditRequest $request, Role $role): RedirectResponse
    {
        $role = $role->fill(
            $request->validated()
        );

        if ($role->save()) {
            return redirect()->route('admin.roles.index')
                ->with('success',  __('messages.admin.roles.update.success'));
        }

        return back()->with('error', __('messages.admin.roles.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            $deleted = $role->delete();
            if ($deleted === false) {
                return \response()->json(['status' => 'error'], 400);
            } else {
                return \response()->json(['status' => 'ok']);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getCode());
            return \response()->json(['status' => 'error'], 400);
        }
    }
}
