<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $trainers = User::query()
            ->where('role_id', 2)
            ->with('tags')
            ->paginate(config('pagination.admin.relations'));

        return view('admin.relations.index', [
            'trainers' => $trainers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  User $trainer
     * @return View
     */
    public function edit(User $trainer): View
    {
        $tags = Tag::all();

        return view('admin.relations.edit', [
            'trainer' => $trainer,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User $trainer
     * @return RedirectResponse
     */
    public function update(Request $request, User $trainer): RedirectResponse
    {
        $tag_id = $request->post('tags');

        //dd($tags);

        $trainer_id = $trainer->id;

        //dd($trainer_id );

        //todo: добавить id в таблицу relations

        //        $trainer->tags()->attach($tag_id, ['user_id' => $trainer_id]);

        $trainer->tags()->sync($tag_id, ['user_id' => $trainer_id]);

        //        $trainer->tags()->updateExistingPivot($tag_id, ['user_id' => $trainer_id]);
        //dd($trainer->tags());

        return redirect()->route('admin.relations.index')
            ->with('success', __('messages.admin.relations.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
