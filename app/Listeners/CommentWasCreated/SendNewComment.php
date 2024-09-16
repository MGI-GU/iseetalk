<?php

namespace App\Listeners\CommentWasCreated;

use App\Events\CommentWasCreated;
use App\Notifications\NewCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewComment
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
    public function handle(CommentWasCreated $event)
    {
        if($event->comment->audio->channel->project){
            $owner = $event->comment->audio->channel->project->project->team->leader->user;
        }else{
            $owner = $event->comment->audio->user;
        }

        Notification::send($owner, new NewCommentNotification($event->comment));
    }
}
