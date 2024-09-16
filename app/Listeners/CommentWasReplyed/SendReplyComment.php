<?php

namespace App\Listeners\CommentWasReplyed;

use App\Events\CommentWasReplyed;
use App\Notifications\ReplyCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendReplyComment
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
    public function handle(CommentWasReplyed $event)
    {
        $reply = $event->comment->comment_own->user;
        Notification::send($reply, new ReplyCommentNotification($event->comment));
    }
}
