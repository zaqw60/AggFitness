<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Http\Requests\Tags\CreateRequest;
use App\Http\Requests\Tags\EditRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::query()->paginate(config('pagination.admin.tags'));

        return view('admin.tags.index', [
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $tag = new Tag(
            $request->validated()
        );

        if($tag->save()) {
            return redirect()->route('admin.tags.index')
                ->with('success', __('messages.admin.tags.create.success'));
        }

        return back()->with('error', __('messages.admin.tags.create.fail'));
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
     * @param  Tag $tag
     * @return View
     */
    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Tag $tag): RedirectResponse
    {
        $tag = $tag->fill($request->validated());

        if($tag->save()) {
            return redirect()->route('admin.tags.index')
                ->with('success',  __('messages.admin.tags.update.success'));
        }

        return back()->with('error', __('messages.admin.tags.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
        try {
            $deleted = $tag->delete();
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
