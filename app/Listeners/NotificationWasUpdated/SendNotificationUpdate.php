<?php

namespace App\Listeners\NotificationWasUpdated;

use App\Events\NotificationWasUpdated;
use App\Notifications\UpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Models\UserNotification;

class SendNotificationUpdate
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
    public function handle(NotificationWasUpdated $event)
    {
        //SENT TO SUBSCIBER CHANNEL
        if(strpos($event->notification->type, '_creator') !== false && strpos($event->notification->type, '_user') == false){
            $subsciber = User::creatorOnly()->get();
        }else{
            $subsciber = User::get();
        }

        if (strpos($event->notification->type, 'email') !== false) {
            Notification::send($subsciber, new UpdateNotification($event->notification));
        }else{
            if($event->notification->user_notification->count()==0){
                // foreach($subsciber as $user){
                //     $notice = new UserNotification;
                //     $notice->notification_id = $event->notification->id;
                //     $notice->user_id = $user->id;
                //     $notice->save();
                // }
                foreach($subsciber as $user){
                    $event->notification->user_notification()->create([
                        'notification_id' => $event->notification->id,
                        'user_id' => $user->id
                    ]);
                }
            }
        }
    }
}
