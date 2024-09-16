<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->setting()->create([
            'language' => 'Indonesia'
        ]);

        // if($user->type == 'streamer'){
        //     $user->channels()->create([
        //         'name'          => $user->name,
        //         'email'         => $user->email,
        //         'description'   => '',
        //         'status'        => 'draft',
        //         'user_id'       => $user->id,
        //     ]);
        // }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->type == 'creator' && $user->channels->count()==0){
            $user->channels()->create([
                'name'          => $user->name,
                'email'         => $user->email,
                'description'   => '',
                'status'        => 'draft',
                'user_id'       => $user->id,
            ]);
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //SETTING
        $user->setting->delete();
        //CHANNEL
        if($user->channels->count() > 0 ){
            $user->channels->delete();
        }
        //AUDIO
        if($user->audios->count() > 0 ){
            $user->audios->delete();
        }
        //ATTACHMENT
        if($user->attachments->count() > 0 ){
            $user->attachments->delete();
        }
        //MEDIAS
        if($user->medias->count() > 0 ){
            $user->medias->delete();
        }
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //SETTING
        $user->setting->restore();
        //CHANNEL
        if($user->channels->count() > 0 ){
            $user->channels->restore();
        }
        //AUDIO
        if($user->audios->count() > 0 ){
            $user->audios->restore();
        }
        //ATTACHMENT
        if($user->attachments->count() > 0 ){
            $user->attachments->restore();
        }
        //MEDIAS
        if($user->medias->count() > 0 ){
            $user->medias->restore();
        }
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //check if member or user cek trello
        if($user->admin()){
            //detach role
            $user->roleusers->forceDelete();
        }
        //SETTING
        $user->setting->forceDelete();
        //CHANNEL
        if($user->channels->count() > 0 ){
            $user->channels->forceDelete();
        }
        //AUDIO
        if($user->audios->count() > 0 ){
            $user->audios->forceDelete();
        }
        //ATTACHMENT
        if($user->attachment_source->count() > 0 ){
            $user->attachment_source->forceDelete();
        }
        //MEDIAS
        if($user->medias->count() > 0 ){
            $user->medias->forceDelete();
        }
    }
}
