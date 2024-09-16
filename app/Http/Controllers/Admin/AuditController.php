<?php

namespace App\Http\Controllers\Admin;

use App\Models\Audit;
use App\Models\Audio;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\AuditWasUpdated;
use App\Events\AudioWasCreated;
use App\Events\AudioWasUpdated;
use App\Events\ChannelWasUpdated;
use App\Models\ContentTag;
use App\Models\Image;
use App\Http\Resources\AuditCollection;
use Carbon\Carbon;

class AuditController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
	{
		if($request->ajax()) {
            if($request->has('filter')){
                if($request->filter=='audio'){
                    $data = Audit::orderBy('id', 'desc')->whereNotIn('status', ['draft','approve'])->active()->audios();
                }elseif($request->filter=='channel'){
                    $data = Audit::orderBy('id', 'desc')->whereNotIn('status', ['draft','approve'])->active()->channels();
                }elseif($request->filter=='all'){
                    $data = Audit::orderBy('id', 'desc')->whereNotIn('status', ['draft','approve']);
                }elseif($request->filter=='publish'){
                    $data = Audit::orderBy('id', 'desc')->where('status', 'approve')->whereDate('updated_at', '>', Carbon::now()->subDays(90))->orderBy('updated_at', 'desc');
                }else{
                    $data = Audit::orderBy('updated_at', 'desc')->where('status', strip_tags($request->filter));
                }
            }else{
                if(is_admin(auth()->user())=='admin'){
                    $data = Audit::orderBy('id', 'desc')->active()->audios();
                }else{
                    $data = Audit::orderBy('status', 'asc')->active()->orderBy('updated_at', 'desc')->whereIn('status',['new','review']);
                }
            }
            $data = $data->get();
            try {
                return new AuditCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('admin.audit.audit');
    }

    public function edit(Audit $audit)
    {
        return view('admin.audit.audit-detail', compact('audit'));
    }

    public function update(Request $request, Audit $audit)
    {
        if($request->has('suspend') && $request->has('notes')) {
            $audit->setRevisi($request->only(['suspend', 'notes']));
        }else{
            $audit->setApprove();
            if($audit->model_type === 'App\Models\Audio'){
                if($audit->audio->parent){
                    try {
                        //BACKUP LAST PUBLISHED PROCESS before update
                        if($audit->audio->parent->backup){
                            $audit->audio->parent->backup->update([
                                'name'          => $audit->audio->parent->name,
                                'description'   => $audit->audio->parent->description,
                                'visibility'    => $audit->audio->parent->visibility,
                                'duration'      => $audit->audio->parent->duration,
                                'allow_comment' => $audit->audio->parent->allow_comment,
                                'sort_comment'  => $audit->audio->parent->sort_comment,
                                'allow_notice'  => $audit->audio->parent->allow_notice,
                                'allow_rating'  => $audit->audio->parent->allow_rating,
                                'allow_age'     => $audit->audio->parent->allow_age,
                                'language'      => $audit->audio->parent->language
                            ]);
                            $backup = $audit->audio->parent->backup;
                        }else{
                            $backup = Audio::create([
                                'name'          => $audit->audio->parent->name,
                                'description'   => $audit->audio->parent->description,
                                'user_id'       => $audit->audio->parent->user_id,
                                'status'        => 'backup',
                                'backup_id'     => $audit->audio->parent->id,
                                'visibility'    => $audit->audio->parent->visibility,
                                'duration'      => $audit->audio->parent->duration,
                                'allow_comment' => $audit->audio->parent->allow_comment,
                                'sort_comment'  => $audit->audio->parent->sort_comment,
                                'allow_notice'  => $audit->audio->parent->allow_notice,
                                'allow_rating'  => $audit->audio->parent->allow_rating,
                                'allow_age'     => $audit->audio->parent->allow_age,
                                'contain'       => $audit->audio->parent->contain,
                                'channel_id'    => $audit->audio->parent->channel_id,
                                'language'      => $audit->audio->parent->language
                            ]);
                        }

                        //REPLACEMENT PROCESS
                        //BASIC DATA
                        $audit->audio->parent->update([
                            'name'          => $audit->audio->name,
                            'description'   => $audit->audio->description,
                            'visibility'    => $audit->audio->visibility,
                            'duration'      => $audit->audio->duration,
                            'allow_comment' => $audit->audio->allow_comment,
                            'sort_comment'  => $audit->audio->sort_comment,
                            'allow_notice'  => $audit->audio->allow_notice,
                            'allow_rating'  => $audit->audio->allow_rating,
                            'allow_age'     => $audit->audio->allow_age,
                            'language'      => $audit->audio->language
                        ]);
                        //UPDATE AUDIO FILE
                        if($audit->audio->audio_source){
                            if($audit->audio->parent->audio_source){
                                $audit->audio->parent->audio_source->update([
                                    'model_id' => $backup->id
                                ]);
                            }else{
                                $audit->audio->parent->audio_user_source->update([
                                    'model_id' => $backup->id,
                                ]);
                            }
                            $audit->audio->audio_source->update([
                                'model_id' => $audit->audio->parent_id
                            ]);
                            $audit->audio->parent->update([
                                'source' => $audit->audio->audio_source->id
                            ]);
                        }
                        //UPDATE ATTACHMENT SLIDE 
                        if($audit->audio->slide){
                            //BACKUP LAST PUBLISH
                            Image::where('audio_id', $audit->audio->parent->id)->update([
                                'audio_id' => $backup->id
                            ]);
                            //UPDATE NEW EDITION TO PUBLISH
                            Image::where('audio_id', $audit->audio->id)->update([
                                'audio_id' => $audit->audio->parent_id
                            ]);
                        }
                        //NOT WORKING
                        //UPDATE ATTACHMENT COVER 
                        if($audit->audio->cover_source){
                            //BACKUP LAST PUBLISH
                            if($audit->audio->parent->cover_source){
                                $audit->audio->parent->cover_source->update([
                                    'model_id' => $backup->id
                                ]);
                            }
                            //UPDATE NEW EDITION TO PUBLISH
                            $audit->audio->cover_source->update([
                                'model_id' => $audit->audio->parent_id
                            ]);
                        }
                        //UPDATE TAG
                        if($audit->audio->tags){
                            $audit->audio->parent->tags()->detach();
                            ContentTag::where('content_tag_type', 'App\Models\Audio')->where('content_tag_id', $audit->audio->id)->update([
                                'content_tag_id' => $audit->audio->parent_id
                            ]);
                        }
                        //DELETE NEW EDITION IF SUCCESS REPLACE
                    } catch (\Exception $e) {
                        return response()->json([$e->getMessage()]);
                        noty($e->getMessage(), 'warning');
                    }
                    $audit->audio->delete();
                }
            }
            if($audit->model_type === 'App\Models\Channel'){
                if($audit->channel->parent){
                    //REPLACE PUBLISH CHANNEL (PARENT) WITH THIS DATA
                    try {
                        //BACKUP LAST PUBLISHED PROCESS before update
                        if($audit->channel->parent->backup){
                            $audit->channel->parent->backup->update([
                                'name' => $audit->channel->parent->name,
                                'description' => $audit->channel->parent->description
                            ]);
                            $backup = $audit->channel->parent->backup;
                        }else{
                            $backup = Channel::create([
                                'name'          => $audit->channel->parent->name,
                                'description'   => $audit->channel->parent->description,
                                'user_id'       => $audit->channel->parent->user_id,
                                'status'        => 'backup',
                                'backup_id'     => $audit->channel->parent->id
                            ]);
                        }
                        $audit->channel->parent->update([
                            'name' => $audit->channel->name,
                            'description' => $audit->channel->description
                        ]);
                        //UPDATE ATTACHMENT COVER & BACKGROUND
                        if($audit->channel->cover_source){
                            if($audit->channel->parent->cover_source){
                                $audit->channel->parent->cover_source->update([
                                    'model_id' => $backup->id
                                ]);
                            }
                            $audit->channel->cover_source->update([
                                'model_id' => $audit->channel->parent->id
                            ]);
                        }
                        if($audit->channel->background_source){
                            if($audit->channel->parent->background_source){
                                $audit->channel->parent->background_source->update([
                                    'model_id' => $backup->id
                                ]);
                            }
                            $audit->channel->background_source->update([
                                'model_id' => $audit->channel->parent->id
                            ]);
                        }
                        //DELETE NEW EDITION IF SUCCESS REPLACE
                        $audit->channel->delete();
                        
                    } catch (\Exception $e) {
                        return response()->json($e->getMessage());
                        noty($e->getMessage(), 'warning');
                    }
                }
            }
        }
        event(new AuditWasUpdated($audit));
        if($audit->status=='approve'){
            // reckecj if kontent is update new edition or new upload
            if($audit->model_type === 'App\Models\Audio'){
                if($audit->audio->parent){
                    event(new AudioWasUpdated($audit->audio));
                }else{
                    event(new AudioWasCreated($audit->audio));
                }
            }elseif($audit->model_type === 'App\Models\Audio'){
                if($audit->audio->parent){
                    event(new ChannelWasUpdated($audit->channel));
                }
            }
        }

        noty('Success update audit', 'success');

        return redirect('admin/audit/');
    }
}