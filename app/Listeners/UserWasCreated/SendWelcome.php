<?php

namespace App\Listeners\UserWasCreated;

use App\Events\UserWasCreated;
use App\Notifications\RegisterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendWelcome
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
    public function handle(UserWasCreated $event)
    {
        Notification::send($event->user, new RegisterNotification($event->user));
    }
}
