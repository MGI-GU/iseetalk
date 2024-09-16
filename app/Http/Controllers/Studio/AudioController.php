<?php

namespace App\Http\Controllers\Studio;

use Auth;
use App\Models\Audio;
use App\Models\Channel;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Events\AudioWasCreated;
use App\Http\Resources\WebAudioCollection;
use App\Http\Requests\Studio\AudioRequest;

class AudioController extends Controller
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
        $user = Auth::user();
        if($request->ajax()) {
            $data = $user->user_audios;
            try {
                //return new AudioResource($data);
                return new WebAudioCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('studio.audio', compact('user'));
    }

    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $audio = Audio::where('id', $id)->where('user_id', get_user()->id)->withTrashed()->first();
        if($audio->deleted_at){
            return redirect()->route('studio.audio.show', [$audio->parent->slug]);
        }
        return view('studio.audio_edit', compact('audio'));
    }

    public function edit(Request $request, $id, $page)
    {
        $id = Hashids::decode($id)[0];
        $audio = Audio::where('id', $id)->where('user_id', get_user()->id)->first();
        if($page=="slide"){
            if($request->ajax()) {
                $data = Image::where('audio_id', $audio->id);

                if(@$request->filter=='deleted'){
                    $data = $data->onlyTrashed()->get();
                }elseif(@$request->filter=='active'){
                    $first = Image::where('audio_id', $audio->id)->where('time_show', 0)->get();
                    $data = $data->where('time_show', '>=', 0)->orderBy('time_show', 'asc')->get();
                    if($first->count()==0){
                        $sample = [
                            'id'        => 1,
                            'source'    => 'pankord/no-first-slide.jpg',
                            'title'     => 'Please set 1st slide',
                            'time_show' => 0
                        ];
                        $data->prepend($sample);
                    }
                }else{
                    $data = $data->where('time_show', null)->where('time_end', null)->orderBy('attachment_id', 'desc')->get();
                }

                return $data->toJson();
            }
            return view('studio.audio_edit_slide', compact('audio'));
        }
        return view('studio.audio_edit_advance', compact('audio'));
    }
    
    public function store(AudioRequest $request){
        $channel = "";
        if($request->has('channel') && $request->get('channel')!=''){
            $channel = Channel::firstOrCreate(['name' => strip_tags($request->get('channel')), 'user_id'=> auth()->user()->id]);
        }

        $allow_notice = ($request->get('allow_comment') === true ? 1:0);
        $allow_rating = ($request->get('allow_rating') === true ? 1:0);
        $allow_age = ($request->get('allow_age') === true ? 1:0);
        $sort_comment = ($request->get('sort_comment') === true ? 1:0);
        $contain = 1;
        $data = Audio::create([
            'source'        => strip_tags($request->source),
            'name'          => strip_tags($request->name),
            'description'   => filterInput($request->description, 'high'),
            'language'      => strip_tags($request->language),
            'visibility'    => $audio->channel->visibility,
            'allow_comment' => strip_tags($request->get('allow_comment')),
            'sort_comment'  => $sort_comment,
            'allow_notice'  => $allow_notice,
            'allow_rating'  => $allow_rating,
            'allow_age'     => $allow_age,
            'contain'       => $contain,
            'channel_id'    => $channel!="" ? $channel->id:0,
            'category_id'   => strip_tags($request->category_id),
            'user_id'       => auth()->user()->id,
        ]);
        
        // event(new AudioWasCreated($data));

        noty('Data saved successfully audio', 'success');

        return redirect()->route('studio.audio.show', [$data->slug]);
    }

    public function update(AudioRequest $request, Audio $audio){
        // return $request;
        if($request->get('allow_comment') === true){
            $allow_comment = ($request->has('allow_comment') ? strip_tags($request->get('allow_comment')):0);
            $allow_rating = ($request->has('allow_rating') ? 1:0);
            $allow_age = ($request->has('allow_age') ? 1:0);
            $sort_comment = ($request->has('sort_comment') ? 1:0);
            $contain = 1; //($request->has('contain') ? 1:0);
            
            $request->request->add(['allow_comment' => $allow_comment]);
            $request->request->add(['allow_rating' => $allow_rating]);
            $request->request->add(['allow_age' => $allow_age]);
            $request->request->add(['sort_comment' => $sort_comment]);
            $request->request->add(['contain' => $contain]);
        }

        if($audio->status=='publish'){
            // return 'new edition';
            // MAKE NEW EDITION AUDIO
            try {
                $allow_comment = ($request->has('allow_comment') ? strip_tags($request->get('allow_comment')):0);
                $allow_rating = ($request->has('allow_rating') ? 1:0);
                $allow_age = ($request->has('allow_age') ? 1:0);
                $sort_comment = ($request->has('sort_comment') ? 1:0);
                $allow_notice = ($request->has('allow_notice') ? 1:0);

                $request->request->add(['allow_comment' => $allow_comment]);
                $request->request->add(['allow_rating' => $allow_rating]);
                $request->request->add(['allow_age' => $allow_age]);
                $request->request->add(['sort_comment' => $sort_comment]);
                $request->request->add(['allow_notice' => $allow_notice]);

                $data = Audio::create([
                    'name'          => strip_tags($request->name),
                    'description'   => filterInput($request->description, 'high'),
                    'user_id'       => auth()->user()->id,
                    'status'        => 'draft',
                    'parent_id'     => $audio->id,
                    'duration'      => $audio->duration,
                    'visibility'    => $audio->channel->visibility,
                    'allow_comment' => $request->allow_comment,
                    'sort_comment'  => $request->sort_comment,
                    'allow_notice'  => $request->allow_notice,
                    'allow_rating'  => $request->allow_rating,
                    'allow_age'     => $request->allow_age,
                    'contain'       => $audio->contain,
                    'channel_id'    => $audio->channel_id,
                    'language'      => strip_tags($request->language) ?? 'none'
                ]);
        
                $data->save();

                $slides = Image::where('audio_id', $audio->id)->get();
                foreach($slides as $slide){
                    $data->slide()->create([
                        'attachment_id' => $slide->attachment_id,
                        'title' => $slide->title,
                        'source' => $slide->source,
                        'time_show' => $slide->time_show,
                        'time_end' => $slide->time_end,
                        'audio_id' => $data->id
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
                noty($e->getMessage(), 'warning');
            }
            noty('Data audio saved successfully in new draft', 'success');
    
            return redirect()->route('studio.audio.show', [$data->slug]);
        }elseif($request->type=='publish'){
            $audio->update([
                'status' => 'review'
            ]);
            $audio->audit->update(['status' => 'new']);
        }else{
            if($audio->status=='revoke'){
                $request->request->add(['status' => 'draft']);
            }
            // NEED TO SECURE AND VALIDATE
            // return $request;
            if($request->has('allow_comment') && $request->has('channel')){
                $audio->update([
                    'allow_comment' => strip_tags($request->allow_comment),
                    'sort_comment'  => strip_tags($request->sort_comment),
                    'allow_rating'  => strip_tags($request->allow_rating),
                    'allow_age'     => strip_tags($request->allow_age),
                    'contain'       => 1,
                    'language'      => strip_tags($request->language),
                    'category_id'   => strip_tags($request->category_id),
                    'channel'       => strip_tags($request->channel),
                ]);
            }else{
                $audio->update([
                    'name'          => strip_tags($request->name),
                    'description'   => filterInput($request->description, 'high'),
                    'visibility'    => $audio->channel->visibility,
                    'contain'       => 1,
                ]);
            }
        }


        if($audio->source !== null && $audio->active_slide->count()>0){
            $status='new';
            if($audio->audit)
                $audio->audit->update(['status' => $status]);
        }

        noty('Berhasil mengupdate audio', 'success');

        return redirect()->back();
    }

    public function status(Audio $audio, $status){
        $update = false;
        if($status=='approve'){
            $audio->update([
                'status'=> 'draft'
            ]);
            $update = true;
        }elseif($status=='reject'){
            $audio->update([
                'status'=> 'draft'
            ]);
            $update = true;
        }elseif($status=='submit'){
            $audio->setWaitApproval();
            $update = true;
        }elseif($status=='revoke'){
            $audio->setRevoke();
            $update = true;
        }elseif($status=='reset'){
            if($audio->backup){
                //BASIC DATA
                $audio->update([
                    'name' => $audio->backup->name,
                    'description' => $audio->backup->description,
                    'duration' => $audio->backup->duration
                ]);
                //UPDATE AUDIO FILE
                if($audio->backup->audio_source){
                    if($audio->audio_source){
                        $audio->audio_source->forceDelete();
                    }
                    $audio->backup->audio_source->update([
                        'model_id' => $audio->id
                    ]);
                }
                //UPDATE ATTACHMENT SLIDE 
                if($audio->backup->slide){
                    foreach($audio->slide as $image){
                        $image->forceDelete();
                    }
                    
                    Image::where('audio_id', $audio->backup->id)->update([
                        'audio_id' => $audio->id
                    ]);
                }
                //UPDATE ATTACHMENT COVER 
                if($audio->backup->cover_source){
                    if($audio->cover_source){
                        $audio->cover_source->forceDelete();
                    }
                    $audio->backup->cover_source->update([
                        'model_id' => $audio->id
                    ]);
                }

                $audio->backup->forceDelete();
            }
            $update = true;
        }
        if($update){
            noty('Data audioslide saved successfully ', 'success');
        }else{
            noty('Terjadi kesalahan saat meng-update audio', 'warning');
        }

        return redirect()->route('studio.audio.show', [$audio->slug]);
    }

    public function order(Request $request){
        foreach($request->id as $key => $id){
            $audio = Audio::find($id);
            $audio->update(['position'=>$key]);
        }
        return response()->json(['result' => 'Berhasil save data']);
    }

    public function destroy($audio)
    {
        $id = Hashids::decode($audio)[0];
        $audio = Audio::where('id', $id)->where('user_id', get_user()->id)->first();

        if(!$audio){
            noty('Unauthorize', 'danger');
            return redirect()->back();
        }
        $audio->delete();
        noty('Berhasil menghapus audio', 'information');
        return redirect()->route('studio.audio.index');
    }
}
