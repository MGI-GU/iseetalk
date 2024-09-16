<?php

namespace App\Listeners\AuditWasUpdated;

use App\Events\AuditWasUpdated;
use App\Notifications\AuditNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAuditUpdate
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
    public function handle(AuditWasUpdated $event)
    {
        // dd(1);
        if($event->audit->model_type === 'App\Models\Audio'){
            if($event->audit->audio->channel->project){
                $owner = $event->audit->audio->channel->project->project->team->leader->user;
            }else{
                $owner = $event->audit->audio->user;
            }
        }else{
            if($event->audit->channel->project){
                $owner = $event->audit->channel->project->project->team->leader->user;
            }else{
                $owner = $event->audit->channel->user;
            }
        }

        Notification::send($owner, new AuditNotification($event->audit));
    }
}
