<?php

namespace App\Http\Controllers\Account;

use App\Events\AccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\GymImage\CreateRequest;
use App\Http\Requests\GymImage\EditRequest;
use App\Models\GymImage;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GymImageController extends Controller
{
    public function __construct()
    {
        $this->model = GymImage::query();
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $gymImages = GymImage::query()
            ->with('gym')
            ->where('gym_id', Auth::user()->gym->id)
            ->paginate(9);
        return view('account.gym_images.index', ['gymImages' => $gymImages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('account.gym_images.create');
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
        if (GymImage::create($validated)) {
            return redirect()->route('account')
                ->with('success', __('messages.account.gym_images.create.success'));
        }
        return back('error', __('messages.account.gym_images.create.fail'));
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
        return view('account.gym_images.edit', [
            'gym_image' => $this->model
                ->where('id', $id)
                ->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param GymImage $gym_image
     * @param UploadService $uploadService
     * @return RedirectResponse
     */
    public function update(EditRequest $request, GymImage $gym_image, UploadService $uploadService): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $uploadService->uploadImage($request->file('image'));
        }
        if ($gym_image->fill($validated)->save()) {
            $user = $gym_image->gym->user;
            AccountEvent::dispatch($user);
            return redirect()->route('account')
                ->with('success', __('messages.account.gym_images.update.success'));
        }
        return back('error', __('messages.account.gym_images.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GymImage $gym_image
     * @return Response
     */
    public function destroy(GymImage $gym_image): JsonResponse
    {
        try {
            $deleted = $gym_image->delete();
            if ($deleted === false) {
                return \response()->json('error', 400);
            }

            return \response()->json('ok');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return \response()->json('error', 400);
        }
    }
}
