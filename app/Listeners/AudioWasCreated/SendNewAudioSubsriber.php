<?php

namespace App\Listeners\AudioWasCreated;

use App\Events\AudioWasCreated;
use App\Notifications\NewAudioChannelNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendNewAudioSubsriber
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
    public function handle(AudioWasCreated $event)
    {
        $subscribers = $event->audio->channel->subscribers;
        if($event->audio->allow_notice){
            Notification::send($subscribers, new NewAudioChannelNotification($event->audio));
        }
    }
}
