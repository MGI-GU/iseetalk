<?php

namespace App\Listeners\TeamWasUpdated;

use App\Events\TeamWasUpdated;
use App\Notifications\UpdateTeamNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendTeamNotificationUpdate
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
    public function handle(TeamWasUpdated $event)
    {
        // Notification::send($event->roleuser, new UpdateTeamNotification($event->user));
    }
}
