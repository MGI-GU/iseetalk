<?php

namespace App\Listeners\ChannelWasUpdated;

use App\Events\ChannelWasUpdated;
use App\Notifications\ChannelUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendChannelUpdate
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
    public function handle(ChannelWasUpdated $event)
    {
        // dd(1);
        //SENT TO SUBSCIBER CHANNEL
        $subscribers = $event->channel->subscribers;

        Notification::send($subscribers, new ChannelUpdateNotification($event->channel));
    }
}
