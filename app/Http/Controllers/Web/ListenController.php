<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Audio;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\AudioShowResource;
use App\Models\Channel;
use App\Http\Resources\AudioListCollection;

class ListenController extends Controller
{
    public function show(Request $request, $id)
    {
        $user_activity = null;
        $subscribe = null;
        $playlist = null;
        $channel = null;
        $next = null;
        
        $id = Hashids::decode($id)[0];
        if($request->ajax()) {
            // $data = AudioShowResource::collection(find_recomendation($id));
            $data = find_recomendation($id);
            try {
                return new AudioListCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($data);
        }
        $audio = Audio::find($id);
        if($audio->channel->visibility=='private' || $audio->status!='publish' || $audio->visibility!='public' ){
            if($audio->status!='publish'){
                return view('web.not_avaiable');
            }
            if($audio->channel->visibility=='private' || $audio->visibility=='private'){
                if(Auth::check()){
                    if($audio->user_id != auth()->user()->id){
                        if(subscribe_this($audio->channel)=='false' || subscribe_this($audio->channel)->approved == 0){
                            return redirect()->route('web.channel.show', [$audio->channel->slug]);
                        }
                    }
                }else{
                    return redirect()->route('login');
                }
            }
        }
        if($request->has('playlist') ){
            $playlist = Playlist::find($request->playlist);
        }elseif( $request->has('channel')){
        }
        $channel = Channel::find($request->get('channel'));
        if(Auth::check()){
            $user_activity = get_my_audio_activity($audio);
            $subscribe = is_my_subscribe($audio->channel);
            $logs = auth()->user()->activitys()->firstOrNew(array('audio_id' => $id));
            $logs->audio_id = $id;
            $logs->listened_at = date('Y-m-d');
            $logs->played_number = $logs->played_number+1;
            $logs->save();
        }
        return view('web.listen', compact('audio', 'user_activity', 'subscribe', 'playlist', 'next', 'channel'));
    }

    public function store(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $audio = Audio::find($id);
        $user_activity = false;
        if(Auth::check()){
            $user_activity = get_my_audio_activity($audio);
            if($request->name=='like'){
                $user_activity->setLike();
            }elseif($request->name=='dislike'){
                $user_activity->setDislike();
            }elseif($request->name=='save'){
                $user_activity->setSave();
            }elseif($request->name=='unsave'){
                $user_activity->setUnsave();
            }elseif($request->name=='share'){
                //share media
            }else{
                //report
            }
        }
        return response()->json($user_activity);
    }

    public function share(Request $request, $id){
        //HERE COUNT SHARE STAT
        $id = Hashids::decode($id)[0];
        $audio = Audio::find($id);
        // return urlencode($request->url);

        $share = $audio->shares()->create([
            'audio_id' => $audio->id,
            'media' => strip_tags($request->media),
            'user_id' => auth()->user() ? auth()->user()->id : 0
        ]);
        if($share){
            if($share->media=='facebook'){
                $url = 'https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u='.urlencode($request->url).'&display=popup&ref=plugin&src=share_button';
            }elseif($share->media=='email'){
                $url = $request->link;
            }else{
                return redirect()->back();
            }
            return redirect()->to($url);
        }
        return redirect()->back();
    }

}
