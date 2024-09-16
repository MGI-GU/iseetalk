<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        // $project->audit()->create([
        //     'model' => 'App\Models\Project',
        //     'model_id' => $project->id
        // ]);
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        // $status='draft';
        // if($project->attachment_source && $project->background_source){
        //     $status='new';
        // }
        // // dd($status);
        // $project->audit->update(['status' => $status]);
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //Channel
        // if($project->channelProject->count() > 0 ){
        //     $project->channelProject->delete();
        // }
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //Channel
        // if($project->channelProject->count() > 0 ){
        //     $project->channelProject->forceDelete();
        // }
    }
}
