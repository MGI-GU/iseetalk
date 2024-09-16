<?php

namespace App\Listeners\UserWasUpdated;

use App\Events\UserWasUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UpdateUserNotification;
use Illuminate\Support\Facades\Log;

class SendUserUpdate
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
    public function handle(UserWasUpdated $event)
    {
        Notification::send($event->user, new UpdateUserNotification($event->user));
    }
}
