<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerReviews\CreateRequest;
use App\Models\TrainerReview;
use App\Queries\TrainerQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerReviewController extends Controller
{
    public function __construct()
    {
        $this->trainerBuilder = new TrainerQueryBuilder;
        $this->model = new TrainerReview();
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
    public function edit(int $trainer_id): View|RedirectResponse
    {
        if (Auth::user()->role_id === 3) {
            return view('trainerReviews.edit', [
                'trainer' => $this->trainerBuilder->getById($trainer_id),
                'trainerBuilder' => $this->trainerBuilder,
            ]);
        } else {
            return redirect()->route('trainers.show', ['id' => $trainer_id, 'city_id' => 0])
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
    public function update(CreateRequest $request, int $trainer_id): RedirectResponse
    {
        $request = $request->validated();
        if ($request['client_id'] !== '0' || $request['trainer_id'] !== '0' || $request['status'] !== 'BLOCKED') {
            $this->trainerBuilder->update(Auth::user(), ['status' => 'BLOCKED']);
            return redirect()->route('account')
                ->with('error', __('messages.reviews.create.danger'));
        }
        $request['client_id'] = Auth::user()->id;
        $request['trainer_id'] = $trainer_id;
        $request['status'] = 'DRAFT';
        if ($this->trainerBuilder->create($this->model, $request)) {
            return redirect()->route('trainers.show', ['id' => $request['trainer_id'], 'city_id' => 0])
                ->with('success', __('messages.reviews.create.success'));
        }
        return redirect()->route('trainers.show', ['id' => $request['trainer_id'], 'city_id' => 0])
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
