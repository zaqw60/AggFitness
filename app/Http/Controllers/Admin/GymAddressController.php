<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GymAddress;
use App\Models\Gym;
use App\Http\Requests\GymAddress\EditRequest;
use App\Http\Requests\GymAddress\CreateRequest;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;

class GymAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $gymAddresses = GymAddress::query()
            ->with('gym')
            ->paginate(config('pagination.admin.gymAddresses'));

//        $gymAddresses = GymAddress::query()
//            ->with('gym')
//            ->with('gymOwner')
//            ->paginate(config('pagination.admin.gymAddresses'));

        return view('admin.gymAddresses.index', ['gymAddresses' => $gymAddresses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $gyms = Gym::query()->get(['id', 'title']);
        return View('admin.gymAddresses.create', ['gyms' => $gyms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $gymAddress = new GymAddress(
            $request->validated()
        );

        if($gymAddress->save()) {
            return redirect()->route('admin.gymAddresses.index')
                ->with('success', __('messages.admin.gymAddresses.create.success'));
        }

        return back()->with('error', __('messages.admin.gymAddresses.create.fail'));
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
     * @param  GymAddress $gymAddress
     * @return View
     */
    public function edit(GymAddress $gymAddress): View
    {
        return view('admin.gymAddresses.edit', ['gymAddress' => $gymAddress]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest $request
     * @param  GymAddress $gymAddress
     * @param  UploadService $uploadService
     * @return RedirectResponse
     */
    public function update(EditRequest $request, GymAddress $gymAddress, UploadService $uploadService): RedirectResponse
    {
        $gymAddress = $gymAddress->fill($request->validated());

        if($gymAddress->save()) {
            return redirect()->route('admin.gymAddresses.index')
                ->with('success',  __('messages.admin.gymAddresses.update.success'));
        }

        return back()->with('error', __('messages.admin.gymAddresses.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GymAddress $gymAddress
     * @return JsonResponse
     */
    public function destroy(GymAddress $gymAddress): JsonResponse
    {
        try {
            $deleted = $gymAddress->delete();
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
