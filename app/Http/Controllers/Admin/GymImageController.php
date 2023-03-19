<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GymImage;
use App\Models\Gym;
use Illuminate\View\View;
use App\Http\Requests\GymImage\EditRequest;
use App\Http\Requests\GymImage\CreateRequest;
use Illuminate\Http\JsonResponse;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;

class GymImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $gymImages = GymImage::query()
            ->with('gym')
            ->orderBy('gym_id', 'ASC')
            ->paginate(config('pagination.admin.gymImages'));

        return view('admin.gymImages.index', ['gymImages' => $gymImages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $gyms = Gym::query()->get(['id', 'title']);
        return View('admin.gymImages.create', ['gyms' => $gyms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest  $request
     * @param UploadService $uploadService
     * @return RedirectResponse
     */
    public function store(CreateRequest $request, UploadService $uploadService): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }

        $gymImages = new GymImage(
            $validated
        );

        if($gymImages->save()) {
            return redirect()->route('admin.gymImages.index')
                ->with('success', __('messages.admin.gymImages.create.success'));
        }

        return back()->with('error', __('messages.admin.gymImages.create.fail'));
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
     * @param  GymImage $gymImage
     * @return View
     */
    public function edit(GymImage $gymImage): View
    {
        return view('admin.gymImages.edit', ['gymImage' => $gymImage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest $request
     * @param  GymImage $gymImage
     * @param  UploadService $uploadService
     * @return RedirectResponse
     */
    public function update(EditRequest $request, GymImage $gymImage, UploadService $uploadService): RedirectResponse
    {
        $gymImage = $gymImage->fill($request->validated());

        if ($request->hasFile('image')) {
            $gymImage['image'] = $uploadService->uploadImage($request->file('image'));
        }

        if($gymImage->save()) {
            return redirect()->route('admin.gymImages.index')
                ->with('success',  __('messages.admin.gymImages.update.success'));
        }

        return back()->with('error', __('messages.admin.gymImages.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GymImage $gymImage
     * @return JsonResponse
     */
    public function destroy(GymImage $gymImage): JsonResponse
    {
        try {
            $deleted = $gymImage->delete();
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
