<?php

namespace App\Listeners;

use App\Models\Moderating;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class AccountUpdateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event): void
    {
        if (isset($event->user) && $event->user instanceof User){
            $event->user->status = 'DRAFT';
            $event->user->save();
            if (isset($event->user->moderating)) {
                $moderating = Moderating::query()
                    ->where('user_id', $event->user->id)
                    ->first();
                $moderating->status = 'IS_PENDING';
                $moderating->save();
            }
        }
    }
}
