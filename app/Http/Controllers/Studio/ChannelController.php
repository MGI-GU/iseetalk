<?php

namespace App\Http\Controllers\Studio;

use Auth;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Events\ChannelWasUpdated;
use App\Http\Resources\WebChannelCollection;
use App\Http\Requests\Studio\ChannelRequest;

class ChannelController extends Controller
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
            $data = $user->user_channels;
            return new WebChannelCollection($data);
            try {
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('studio.channel', compact('user'));
    }

    public function create(){
        if(auth()->user()->type=="creator" || auth()->user()->type=="member" || auth()->user()->type=="admin"){
            return view('studio.channel_create');
        }
        SweetAlert::success('Please verification your account first. Thanks');
        return redirect('/');
    }

    public function store(ChannelRequest $request){
        $channel = Channel::create([
            'name' => strip_tags($request->get('name')),
            'description' => filterInput($request->description, 'high'),
            'user_id' => auth()->user()->id,
            'visibility' => strip_tags($request->get('visibility')),
            'status' => 'draft'
        ]);
        $channel->save();

        noty('Data saved successfully channel', 'success');

        return redirect()->route('studio.channel.edit', [$channel->slug]);
    }

    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $data = Channel::where('id', $id)->where('user_id', get_user()->id)->first();
        // if($data->has('edition')){
        //     $data = Channel::where('id', $data->edition->id)->where('user_id', get_user()->id)->first();
        // }
        if($request->has('subscription') || $request->has('request')){
            $subscribe = $data->subscriber_active;
            if($request->has('request')){
                $subscribe = $data->subscriber_request;
            }
            return view('studio.channel_subscriber', compact('data', 'subscribe'));
        }
        $subscriber = $data->subscriber_active->count() ?? 0;
        $request = $data->subscriber_request->count() ?? 0;
        return view('studio.channel_edit', compact('data','subscriber','request'));
    }
    
    public function edit(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $data = Channel::where('id', $id)->where('user_id', get_user()->id)->first();
        if($request->ajax()) {
            $data = $data->audios;
            return response()->json($data);
        }
        return view('studio.channel_arrange_audio', compact('data'));
    }

    public function update(ChannelRequest $request, Channel $channel){
        // return $request;
        $data = [
            'name'          => strip_tags($request->name),
            'description'   => strip_tags($request->description),
            'visibility'    => strip_tags($request->visibility),
        ];

        $last_visibility = $channel->visibility;
        // if($channel->attachment_source && $channel->background_source){
        //     $data['status'] = 'review';
        // }
        if($channel->status=='publish'){
            // MAKE NEW EDITION CHANNEL
            $data = Channel::create([
                'name' => strip_tags($request->get('name')),
                'description' => strip_tags($request->get('description')),
                'user_id' => auth()->user()->id,
                'status' => 'draft',
                'parent_id' => $channel->id,
            ]);

            if($data){
                noty('successfully update new edition channel', 'success');
                event(new ChannelWasUpdated($channel));

                return redirect()->route('studio.channel.edit', [$data->slug]);
            }
        }elseif($request->type=='publish'){
            $channel->update([
                'status' => 'review'
            ]);
            // $channel->audit->update(['status' => 'new']);
        }else{
            $channel->update($data);
        }

        if($last_visibility != $channel->visibility){
            $channel->active_audios()->update([
                'visibility' => $channel->visibility
            ]);
        }
        
        noty('successfully updated channel', 'success');
        event(new ChannelWasUpdated($channel));

        return redirect()->route('studio.channel.edit', [$channel->slug]);
    }

    public function status(Channel $channel, $status){
        $update = false;
        if($status=='approve'){
            $channel->update([
                'status'=> 'draft'
            ]);
            $update = true;
        }elseif($status=='reject'){
            $channel->update([
                'status'=> 'draft'
            ]);
            $update = true;
        }elseif($status=='submit'){
            $channel->setWaitApproval();
            $update = true;
        }elseif($status=='revoke'){
            $channel->setRevoke();
            $update = true;
        }elseif($status=='reset'){
            if($channel->backup){
                //BASIC DATA
                $channel->update([
                    'name' => $channel->backup->name,
                    'description' => $channel->backup->description,
                    'duration' => $channel->backup->duration
                ]);
                //UPDATE ATTACHMENT COVER 
                if($channel->backup->cover_source){
                    if($channel->cover_source){
                        $channel->cover_source->forceDelete();
                    }
                    $channel->backup->cover_source->update([
                        'model_id' => $channel->id
                    ]);
                }
                //UPDATE ATTACHMENT BACKGROUND 
                if($channel->backup->background_source){
                    if($channel->background_source){
                        $channel->background_source->forceDelete();
                    }
                    $channel->backup->background_source->update([
                        'model_id' => $channel->id
                    ]);
                }

                $channel->backup->forceDelete();
            }
            $update = true;
        }
        if($update){
            noty('Data channel saved successfully ', 'success');
        }else{
            noty('Terjadi kesalahan saat meng-update channel', 'warning');
        }

        return redirect()->route('studio.channel.edit', [$channel->slug]);
    }

    public function subscriber(Request $request, $id){
        $id = Hashids::decode($id)[0];
        $channel = Channel::where('id', $id)->where('user_id', get_user()->id)->first();
        // return $request;
        // $data = array('id' => $request->subscriber_id);

        $log = $channel->subscriber()->find($request->subscriber_id);

        if($request->type=='delete'){
            $log->delete();
            noty('successfully delete subscriber', 'success');
        }elseif($request->type=='confirm'){
            $log->approved = 1;
            $log->save();
            noty('successfully approve subscriber', 'success');
        }else{
            noty('Nothing is changes', 'error');
        }
        return redirect()->back();

    }

    public function destroy($channel)
    {
        $id = Hashids::decode($channel)[0];
        $channel = Channel::where('id', $id)->where('user_id', get_user()->id)->first();

        if(!$channel){
            noty('Unauthorize', 'danger');
            return redirect()->back();
        }
        $channel->setDelete();
        noty('Berhasil menghapus channel', 'information');
        
        return redirect()->route('web.channel.index');
    }

    public function delete(Request $request)
    {
        $selects = Channel::whereIn('id', $request->id)->get();
        return delete_data($selects);
    }
}
