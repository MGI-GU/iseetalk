<?php

namespace App\Observers;

use App\Models\Tag;
use App\Models\Audio;
use App\Models\Playlist;

class AudioObserver
{
    /**
     * Handle the audio "created" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function created(Audio $audio)
    {
        $status = 'draft';
        if($audio->audio_source){
            $status = 'new';
        }
        $audio->audit()->create([
            'status' => $status
        ]);
        
        if(request()->has('tags')){
            $hastag = explode(",",strip_tags(request()->get('tags')));
            $tags = array();
            foreach ( $hastag as $key => $tag) {
                $getTag = Tag::firstOrCreate(['name' => $tag]);
                $tags[$key] = $getTag;
            }
            $audio->tags()->saveMany($tags);
        }
        if(request()->has('playlist')){
            $playlists = explode(",",strip_tags(request()->get('playlist')));
            if(count($playlists)>0){
                foreach ($playlists as $key => $value) {
                    $playlist = Playlist::firstOrCreate(['name' => $value, 'channel_id'=>$audio->channel_id]);
                    $audio->playlists()->attach($playlist->id);
                }
            }
        }

        if($audio->source==NULL){
            if($audio->channel->project){
                $audio->category_id = $audio->channel->project->project->team->categoryTeam->category->id;
                $audio->save();
            }
        }
    }

    /**
     * Handle the audio "updated" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function updated(Audio $audio)
    {
        if(request()->has('tags')){
            $hastag = explode(",",strip_tags(request()->get('tags')));
            $tags = array();
            $audio->tags()->detach();
            foreach ( $hastag as $key => $tag) {
                $getTag = Tag::firstOrCreate(['name' => $tag]);
                $tags[$key] = $getTag;
            }
            $audio->tags()->saveMany($tags);
        }
        if(request()->has('playlist')){
            $playlists = explode(",",strip_tags(request()->get('playlist')));
            if(count($playlists)>0){
                $audio->playlists()->detach();
                foreach ($playlists as $key => $value) {
                    $playlist = Playlist::firstOrCreate(['name' => $value, 'channel_id'=>$audio->channel_id]);
                    $audio->playlists()->attach($playlist->id);
                }
            }
        }

        $status='';
        if($audio->status=='unpublish' || $audio->status=='publish'){
            $status='';
        }else if($audio->project){
            if($audio->audit->status!='new'){
                if($audio->project->status=='review'){
                    $status='new';
                }
            }
            if($audio->status=='revision'){
                $audio->project->update([
                    'status'=>'step1'
                ]);
                $status='draft';
            }
        }else{
            if($audio->source !== null && $audio->active_slide->count()>0){
                $status='new';
            }
        }
        if($audio->audit && $status != ''){
            $audio->audit->update(['status' => $status]);
        }
    }

    /**
     * Handle the audio "deleted" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function deleted(Audio $audio)
    {
        //audit
        if($audio->audit){
            $audio->audit->delete();
        }
        //comments
        if($audio->comments->count() > 0){
            $audio->comments->delete();
        }
        if(!$audio->parent){
            //attachment_source
            if($audio->attachment_source){
                $audio->attachment_source->delete();
            }
            //cover_source
            if($audio->cover_source){
                $audio->cover_source->delete();
            }
        }
        //user activity
        if($audio->played->count() > 0){
            $audio->played->each->delete();
        }
    }

    /**
     * Handle the audio "restored" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function restored(Audio $audio)
    {
        //audit
        if($audio->audit){
            $audio->audit->restore();
        }
        //comments
        if($audio->comments->count() > 0){
            $audio->comments->restore();
        }
        //attachment_source
        if($audio->attachment_source){
            $audio->attachment_source->restore();
        }
        //cover_source
        if($audio->cover_source){
            $audio->cover_source->restore();
        }
        //user activity
        if($audio->played){
            $audio->played->each->restore();
        }
    }

    /**
     * Handle the audio "force deleted" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function forceDeleted(Audio $audio)
    {
        $audio->playlists()->detach();
        $audio->tags()->detach();

        //audit
        if($audio->audit){
            $audio->audit->forceDelete();
        }
        //comments
        if($audio->comments->count() > 0){
            $audio->comments->forceDelete();
        }
        if(!$audio->parent){
            //attachment_source
            if($audio->attachment_source){
                $audio->attachment_source->forceDelete();
            }
            //cover_source
            if($audio->cover_source){
                $audio->cover_source->forceDelete();
            }
        }
        //user activity
        if($audio->played){
            $audio->played->each->forceDelete();
        }
    }
}
