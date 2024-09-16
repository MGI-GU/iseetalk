<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\User;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\WebChannelCollection;
use App\Http\Resources\AudioListCollection;

class ChannelController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('web.channel_index', compact('user'));
    }
    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $channel = Channel::find($id);
        if($channel->status!='publish'){
            return view('web.not_avaiable');
        }
        $own_this = owner_this($channel);
        $subscribe = subscribe_this($channel);
        if($request->ajax()) {
            $audio = $channel->audios()->publish()->paginate(5);
            try {
                return new AudioListCollection($audio);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($audio);
        }
        return view('web.channel', compact('channel', 'own_this', 'subscribe'));
    }
    public function page(Request $request, $id, $page)
    {
        $id = Hashids::decode($id)[0];
        $channel = Channel::find($id);
        $own_this = owner_this($channel);
        $subscribe = subscribe_this($channel);
        if($request->ajax()) {
            $audio = $channel->audios()->showPublic()->paginate(5);
            try {
                return new AudioListCollection($audio);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($audio);
        }
        return view('web.channel', compact('channel', 'page', 'own_this', 'subscribe'));
    }
    public function browse(Request $request){
        $user_activity = null;
        $subscribe = null;
        //return $channels = Channel::withCount('audios')->paginate(2);
        if($request->ajax()) {
            $channels = Channel::show()->unsubscribe()->where('type', $request->category)->paginate(6);
            if(count($channels)==0){
                $channels = Channel::withCount('audios')->show()->unsubscribe()->paginate(6);
            }
            try {
                return new WebChannelCollection($channels);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($channels);
        }
        return view('web.browse', compact('user_activity', 'subscribe'));
    }
    public function user($id)
    {
        $id = Hashids::decode($id)[0];
        $user = User::find($id);
        return view('web.channel_index', compact('user'));
    }

}
