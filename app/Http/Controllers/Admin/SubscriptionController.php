<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Http\Requests\Subscriptions\EditRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recycledSubscriptionCount = Subscription::onlyTrashed()->count();

        $subscriptions = Subscription::query()
            ->when($request->has('trashed'), function ($query) {
                $query->onlyTrashed();
            })
            ->get();

        return View('admin.subscriptions.index', [
            'subscriptions' => $subscriptions,
            'recycled' => $recycledSubscriptionCount
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  Subscription $subscription
     * @return View
     */
    public function edit(Subscription $subscription): View
    {
        return view('admin.subscriptions.edit', [
            'subscription' => $subscription
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditRequest $request
     * @param  Subscription $subscription
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Subscription $subscription): RedirectResponse
    {
        $subscription = $subscription->fill(
            $request->validated()
        );

        if ($subscription->save()) {
            return redirect()->route('admin.subscriptions.index')
                ->with('success', __('messages.admin.subscriptions.update.success'));
        }

        return back()->with('error', __('messages.admin.subscriptions.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscription $subscription
     *
     * @return JsonResponse
     */
    public function destroy(Subscription $subscription): JsonResponse
    {
        try {
            $deleted = $subscription->delete();
            $recycledSubscriptionCount = Subscription::onlyTrashed()->count();

            if ($deleted === false) {
                return \response()->json(['status' => 'error'], 400);
            } else {
                return \response()->json([
                    'success' => true,
                    'message' => __('messages.admin.subscriptions.destroy.recycle'),
                    'recycled' => $recycledSubscriptionCount
                ], 200);
            }

        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getCode());
            return \response()->json(['status' => 'error'], 400);
        }
    }

    /**
     * Restore Subscription by Id.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $restore = $subscription->restore();

        if ($restore === false) {
            return redirect()->route('admin.subscriptions.index', ['trashed'])
                ->with('error', __('messages.admin.subscriptions.restore.fail'));
        } else {
            return redirect()->route('admin.subscriptions.index', ['trashed'])
                ->with('success', __('messages.admin.subscriptions.restore.success'));
        }
    }

    /**
     * Force delete Subscription by Id.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function forceDelete($id): RedirectResponse
    {
        try {
            $subscription = Subscription::onlyTrashed()->findOrFail($id);
            $deleted = $subscription->forceDelete();

            if ($deleted === false) {
                return redirect()->route('admin.subscriptions.index', ['trashed'])
                    ->with('error', __('messages.admin.subscriptions.destroy.fail'));
            } else {
                return redirect()->route('admin.subscriptions.index', ['trashed'])
                    ->with('success', __('messages.admin.subscriptions.destroy.success'));
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . ' ' . $e->getCode());
            return redirect()->route('admin.subscriptions.index', ['trashed'])
                ->with('error', __('messages.admin.subscriptions.destroy.fail'));
        }
    }
}
