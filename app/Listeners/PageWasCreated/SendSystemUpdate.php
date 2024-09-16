<?php

namespace App\Listeners\PageWasCreated;

use App\Events\PageWasCreated;
use App\Notifications\InformationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendSystemUpdate
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
    public function handle(PageWasCreated $event)
    {
        $targets = User::whereIn('type', ['member','creator'])->get();
        if($event->page->status=='publish'){
            Notification::send($targets, new InformationNotification($event->page));
        }
    }
}
