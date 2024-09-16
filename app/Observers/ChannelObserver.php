<?php

namespace App\Observers;

use App\Models\Channel;

class ChannelObserver
{
    /**
     * Handle the channel "created" event.
     *
     * @param  \App\Channel  $channel
     * @return void
     */
    public function created(Channel $channel)
    {
        $channel->audit()->create([
            'model' => 'App\Models\Channel',
            'model_id' => $channel->id
        ]);
    }

    /**
     * Handle the channel "updated" event.
     *
     * @param  \App\Channel  $channel
     * @return void
     */
    public function updated(Channel $channel)
    {
        $status='draft';
        if($channel->status=='new' ){
            if( $channel->attachment_source && $channel->background_source){
                $status='review';
            }
        }
        if($channel->status=='upload'){
            if( $channel->attachment_source && $channel->background_source){
                $status='new';
            }
        }
        
        if($channel->status!='unpublish' && $channel->status!='publish' && $channel->status!='approve'){
            $channel->audit->update(['status' => $status]);
        }
    }

    /**
     * Handle the channel "deleted" event.
     *
     * @param  \App\Channel  $channel
     * @return void
     */
    public function deleted(Channel $channel)
    {
        //SUBSCIBER
        if($channel->subscriber->count() > 0 ){
            $channel->subscriber->delete();
        }
        //AUDIO
        if($channel->audios->count() > 0 ){
            $channel->audios->delete();
        }
        //playlists
        if($channel->playlists->count() > 0 ){
            $channel->playlists->delete();
        }
        //audit
        if($channel->audit){
            $channel->audit->delete();
        }
        if(!$channel->parent){
            //cover_source
            if($channel->cover_source){
                $channel->cover_source->delete();
            }
            //background_source
            if($channel->background_source){
                $channel->background_source->delete();
            }
        }
        //contentProject
        if($channel->project){
            $channel->project->delete();
        }
    }

    /**
     * Handle the channel "restored" event.
     *
     * @param  \App\Channel  $channel
     * @return void
     */
    public function restored(Channel $channel)
    {
        //
    }

    /**
     * Handle the channel "force deleted" event.
     *
     * @param  \App\Channel  $channel
     * @return void
     */
    public function forceDeleted(Channel $channel)
    {
        //SUBSCIBER
        if($channel->subscriber->count() > 0 ){
            $channel->subscriber->forceDelete();
        }
        //AUDIO
        if($channel->audios->count() > 0 ){
            $channel->audios->forceDelete();
        }
        //playlists
        // if($channel->playlists->count() > 0 ){
        //     $channel->playlists->forceDelete();
        // }
        //audit
        if($channel->audit){
            $channel->audit->forceDelete();
        }
        //attachment_source
        if($channel->attachment_source){
            $channel->attachment_source->forceDelete();
        }
        //background_source
        if($channel->background_source){
            $channel->background_source->forceDelete();
        }
        //contentProject
        if($channel->project){
            $channel->project->forceDelete();
        }
    }
}
