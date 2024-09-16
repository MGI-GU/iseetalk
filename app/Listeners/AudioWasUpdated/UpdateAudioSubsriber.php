<?php

namespace App\Listeners\AudioWasUpdated;

use App\Events\AudioWasUpdated;
use App\Notifications\AudioUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class UpdateAudioSubsriber
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
    public function handle(AudioWasUpdated $event)
    {
        $subscribers = $event->audio->channel->subscribers;
        if($event->audio->allow_notice){
            Notification::send($subscribers, new AudioUpdateNotification($event->audio));
        }
    }
}
