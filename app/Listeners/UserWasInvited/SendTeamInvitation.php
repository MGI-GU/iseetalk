<?php

namespace App\Listeners\UserWasInvited;

use App\Events\UserWasInvited;
use App\Notifications\InviteTeamNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendTeamInvitation
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
    public function handle(UserWasInvited $event)
    {
        // if($event->user->roleusers->today())
        Notification::send($event->user, new InviteTeamNotification($event->user, $event->team));
    }
}
