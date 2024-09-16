<?php

namespace App\Http\Controllers\Studio;

use Auth;
use App\User;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class DashboardController extends Controller
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

    public function index()
    {
        $user = Auth::user();
        return view('studio.index', compact('user'));
    }
    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $channel = Channel::find($id);
        $own_this = owner_this($channel);
        if($request->ajax()) {
            $audio = $channel->audios()->paginate(5);
            return response()->json($audio);
        }
        return view('web.channel', compact('channel', 'own_this'));
    }
    public function page(Request $request, $id, $page)
    {
        $id = Hashids::decode($id)[0];
        $channel = Channel::find($id);
        $own_this = owner_this($channel);
        if($request->ajax()) {
            $audio = $channel->audios()->paginate(5);
            return response()->json($audio);
        }
        return view('web.channel', compact('channel', 'page', 'own_this'));
    }
    public function browse(Request $request){
        $user_activity = null;
        $subscribe = null;
        if($request->ajax()) {
            $channels = Channel::show()->where('category', $request->category)->paginate(12);
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
