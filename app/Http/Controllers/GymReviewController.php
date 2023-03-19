<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymReview\CreateRequest;
use App\Models\GymReview;
use App\Queries\GymQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class GymReviewController extends Controller
{
    public function __construct()
    {
        $this->gymBuilder = new GymQueryBuilder;
        $this->model = new GymReview();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CreateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $gym_id): View|RedirectResponse
    {
        if (Auth::user()->role_id === 3) {
            return view('gymReviews.edit', [
                'gym' => $this->gymBuilder->getById($gym_id),
                'gymBuilder' => $this->gymBuilder,
            ]);
        } else {
            return redirect()->route('gyms.show', ['id' => $gym_id, 'city_id' => 0])
                ->with('info', __('messages.reviews.create.client'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRequest $request, int $gym_id): RedirectResponse
    {
        $request = $request->validated();
        if ($request['client_id'] !== '0' || $request['gym_id'] !== '0' || $request['status'] !== 'BLOCKED') {
            $this->gymBuilder->update(Auth::user(), ['status' => 'BLOCKED']);
            return redirect()->route('account')
                ->with('error', __('messages.reviews.create.danger'));
        }
        $request['client_id'] = Auth::user()->id;
        $request['gym_id'] = $gym_id;
        $request['status'] = 'DRAFT';
        if ($this->gymBuilder->create($this->model, $request)) {
            return redirect()->route('gyms.show', ['id' => $request['gym_id'], 'city_id' => 0])
                ->with('success', __('messages.reviews.create.success'));
        }
        return redirect()->route('gyms.show', ['id' => $request['gym_id'], 'city_id' => 0])
            ->with('error', __('messages.reviews.create.fail'));
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
