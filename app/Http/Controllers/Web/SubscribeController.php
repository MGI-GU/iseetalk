<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Channel;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\AudioListCollection;

class SubscribeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = get_subscribe_audio_list('all');
            try {
                return new AudioListCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($data);
        }
        if(Auth::check()){
            return view('web.subscriptions');
        }
        return redirect('login');
    }

    public function store(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $channel = Channel::find($id);

        if(Auth::check()){
            if($request->name=='subscribe'){
                $data = array('subscriber_id' => auth()->user()->id);
                if($channel->visibility=='private'){
                    $data = array('subscriber_id' => auth()->user()->id, 'approved' => 0);
                }
                $logs = $channel->subscriber()->firstOrNew($data);
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
