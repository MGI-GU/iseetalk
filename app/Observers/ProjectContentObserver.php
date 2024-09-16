<?php

namespace App\Observers;

use App\Models\ContentProject;

class ProjectContentObserver
{
    /**
     * Handle the ContentProject "updated" event.
     *
     * @param  \App\ContentProject  $contentProject
     * @return void
     */
    public function updated(ContentProject $contentProject)
    {
        if($contentProject->audio){
            $status='draft';
            if($contentProject->status=='complete'){
                $status='new';
                $contentProject->audio->audit->update(['status' => $status, 'admin_id' => 0, 'noted' => NULL]);
            }
        }
    }
}
