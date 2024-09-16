<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax() && Auth::check()) {
            $user = Auth::user();
            $data = $user->subscribtions()->with('channel')->paginate(5);
            return response()->json($data);
        }
        return view('web.channel-list');
    }
    public function show(Request $request, $name)
    {
        $user = Auth::user();
        if($name=='channel' || $name=='subscription'){
            if($request->ajax() && Auth::check()) {
                $data = $user->subscribtions()->with('channel')->paginate(5);
                return response()->json($data);
            }
            return view('web.channel-list');
        }elseif($name=='history'){
            $data = get_my_activity();
            return view('web.feed', compact('name', 'data', 'user'));
        }elseif($name=='saved'){
            $data = get_my_later_listen();
            return view('web.feed', compact('name', 'data', 'user'));
        }elseif($name=='liked'){
            $data = get_my_liked();
            return view('web.feed', compact('name', 'data', 'user'));
        }else{
            $name = Hashids::decode($id)[0];
            $channel = Channel::find($id);
            $own_this = owner_this($channel);
            if($request->ajax()) {
                $audio = $channel->audios()->paginate(5);
                return response()->json($audio);
            }
            return view('web.channel', compact('channel', 'own_this'));
        }
    }
    public function store(Request $request, $name, $id)
    {
        $id = Hashids::decode($id)[0];
        $channel = Channel::find($id);

        if(Auth::check()){
            if($request->name=='subscribe'){
                $logs = $channel->subscriber()->firstOrNew(array('subscriber_id' => auth()->user()->id));
                $logs->subscriber_id = auth()->user()->id;
                $logs->user_id = $channel->user->id;
                $logs->save();

            }elseif($request->name=='unsubscribe'){
                $logs = $channel->subscriber()->firstOrNew(array('subscriber_id' => auth()->user()->id));
                $logs->delete();
            }elseif($request->name=='alert'){
                $logs = $channel->subscriber()->firstOrNew(array('subscriber_id' => auth()->user()->id));
                $logs->setAlert();
            }elseif($request->name=='none'){
                $logs = $channel->subscriber()->firstOrNew(array('subscriber_id' => auth()->user()->id));
                $logs->setUnalert();
            }
            return response()->json($logs);
        }
        return response()->json(false);

    }
}
