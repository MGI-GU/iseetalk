<?php

namespace App\Observers;

use App\Models\Audit;
use App\Models\Audio;
use App\Models\Channel;
use App\Models\ContentTag;

class AuditObserver
{
    /**
     * Handle the Audit "created" event.
     *
     * @param  \App\Audit  $audit
     * @return void
     */
    public function created(Audit $audit)
    {
        if($audit->audio && $audit->audio->project){
            $audit->audio()->update(['status' => 'draft']);
        }
    }
    /**
     * Handle the audit "updated" event.
     *
     * @param  \App\Audit  $audit
     * @return void
     */
    public function updated(Audit $audit)
    {
        $status = "";
        if($audit->status=='approve'){
            $status = 'publish';
        }elseif($audit->status=='suspend'){
            $status = 'revision';
        }elseif($audit->status=='draft'){
            $status = 'draft';
        }elseif($audit->status=='new' || $audit->status=='review'){
            $status = 'review';
        }
        
        if($status != ''){
            if($audit->model_type === 'App\Models\Audio'){
                if( $status == 'revision' ){
                    if($audit->audio->status != 'suspend'){
                        $audit->audio()->update(['status' => 'suspend']);
                        if($audit->audio->project){
                            $audit->audio->project->update([
                                'status'=>'step1'
                            ]);
                        }
                    }
                }else if($status == 'publish'){
                    if($audit->audio->status != 'publish'){
                        $audit->audio()->update(['status' => $status, 'visibility' => 'public']);
                    }
                }else if($status == 'review'){
                    if($audit->audio->status != 'review'){
                        $audit->audio()->update(['status' => $status]);
                    }
                }
            }elseif($audit->model_type === 'App\Models\Channel'){
                if($audit->status!=$status){
                    if($audit->status!='new' && $audit->channel->status!='review'){
                        if($audit->channel->status != $status){
                            $audit->channel()->update(['status' => $status]);
                        }
                    }
                }
            }
        
            // if($audit->status=='new'){
            //     $audit->update(['admin_id' => NULL, 'noted' => NULL]);
            // }
            if($audit->status!='draft' && $audit->status!='new' && $audit->status!='review'){
                $audit->logs()->create([
                    'audit_id'  => $audit->id,
                    'admin_id'  => $audit->admin_id,
                    'status'    => $audit->status,
                    'noted'     => $audit->notes != NULL ? json_encode($audit->notes) : NULL
                ]);
            }
        }
    }
}
