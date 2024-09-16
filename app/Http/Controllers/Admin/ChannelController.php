<?php

namespace App\Http\Controllers\Admin;

use Analytics;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Analytics\Period;
use App\Events\ChannelWasUpdated;
use App\Http\Resources\ChannelCollection;
use Vinkla\Hashids\Facades\Hashids;

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
        abort_unless(\Gate::allows("VIEW CHANNEL"), 403);
		if($request->ajax()) {
            $filter = [];
            $data = Channel::orderBy('id', 'desc');
            if($request->has('filter')){
                if($request->filter=='publish' || $request->filter=='review' || $request->filter=='draft'){
                    $filter = ['status' => strip_tags($request->filter)];
                    // $data = $data->whereIn('status', ['publish','public']);
                    // $data = $data->whereIn('status', ['pending']);
                }elseif($request->filter=='deleted'){
                    $filter = ['deleted_at' => strip_tags($request->filter)];
                    // $data = $data->onlyTrashed();
                }elseif($request->filter=='all'){
                    $filter = ['all' => strip_tags($request->filter)];
                }
            }
            if($request->has('search')){
                $filter['search'] = strip_tags($request->search);
            }
            if($request->has('offset')){
                $filter['offset'] = strip_tags($request->offset);
            }
            if($request->has('limit')){
                $filter['limit'] = strip_tags($request->limit);
            }
            $data = get_own_channel($filter);//$data->get();
            try {
                $collection = new ChannelCollection($data);
                return $json = [
                    "rows" => $collection,
                    "total" => $data->total(),
                    "totalNotFiltered" => $data->total()
                ];
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('admin.channel.channel');
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows("CREATE CHANNEL"), 403);
        return view('admin.channel.channel-add', compact('request'));
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows("CREATE CHANNEL"), 403);
        $data = Channel::create([
            'name'          => strip_tags($request->get('name')),
            'description'   => filterInput($request->get('description'), 'high'),
            'user_id'       => auth()->user()->id,
            'status'        => 'draft'
        ]);

        $data->project()->create([
            'model'         => 'channel',
            'project_id'    => strip_tags($request->get('project')),
        ]);

        $data->category = $data->project->project->team->categoryTeam->category->id;
        $data->save();

        noty('Data saved successfully channel', 'success');

        return redirect()->route('admin.channel.show', [$data->format_id]);
    }

    public function show(Request $request, $channel)
    {
        abort_unless(\Gate::allows("VIEW CHANNEL"), 403);
        $id = Hashids::connection('channel')->decode($channel)[0];
        $channel = Channel::find($id);

        if(auth()->user()->type!='admin' && $channel->project || $channel->parent){
            if($channel->parent){
                abort_unless(in_array(auth()->user()->id, get_team_user($channel->parent->project->project->team_id)->toArray()), 403);
            }else{
                abort_unless(in_array(auth()->user()->id, get_team_user($channel->project->project->team_id)->toArray()), 403);
            }
        }elseif(!$channel->project){
            abort_unless(auth()->user()->type=='admin', 403);
        }

        if(stripos('draft, revision, reject', $channel->status) !== false && $channel->project){
            return view('admin.channel.channel-add-upload', compact('channel'));
        }elseif($channel->status=='upload' && $channel->project){
            return view('admin.channel.channel-add-submit', compact('channel'));
        }else{
            return view('admin.channel.channel-detail', compact('channel'));
        }
    }

    public function edit(Request $request, Channel $channel)
    {
        abort_unless(\Gate::allows("UPDATE CHANNEL"), 403);
        if(auth()->user()->type!='admin' && $channel->project || $channel->parent){
            if($channel->parent){
                abort_unless(in_array(auth()->user()->id, get_team_user($channel->parent->project->project->team_id)->toArray()), 403);
            }else{
                abort_unless(in_array(auth()->user()->id, get_team_user($channel->project->project->team_id)->toArray()), 403);
            }
        }elseif(!$channel->project){
            abort_unless(auth()->user()->type=='admin', 403);
        }
        return view('admin.channel.channel-edit', compact('channel'));
    }

    public function analytic(Request $request, Channel $channel)
    {
        abort_unless(\Gate::allows("VIEW CHANNEL"), 403);
        if(auth()->user()->type!='admin' && $channel->project){
            abort_unless(in_array(auth()->user()->id, get_team_user($channel->project->project->team_id)->toArray()), 403);
        }elseif(!$channel->project){
            abort_unless(auth()->user()->type=='admin', 403);
        }
        if($request->ajax()){
            $dimensi = 'ga:yearMonth';
            $analyticsData = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews, ga:sessions, ga:users',
                    'dimensions' => $dimensi,
                    'filters' => 'ga:pagePath=~channel/'.$channel->slug
                ]
            );

            $data = $analyticsData->rows;
            foreach($data as $key => $row){
                $ga['label'][$key] = ga_date_readable($row[0]);
                $ga['reach'][$key] = $row[1];
                $ga['enagement'][$key] = $row[2];
                $ga['audiance'][$key] = $row[3];
            }
            $total = $analyticsData->totalsForAllResults;
            $i = 0;
            foreach($total as $t){
                $sum[$i] = $t;
                $i +=1;
            }
            return ['data' => $ga, 'total' => $sum, 'chart' => $data];
        }
        return view('admin.channel.channel-analytic', compact('channel'));
    }

    public function audit(Request $request, Channel $channel)
    {
        abort_unless(\Gate::allows("AUDIT CHANNEL"), 403);
        return view('admin.channel.channel-audit', compact('channel'));
    }

    public function update(Request $request, Channel $channel)
    {
        abort_unless(\Gate::allows("UPDATE CHANNEL"), 403);
        $update = false;
        if(stripos('draft, revision, reject', $channel->status)!==false){
            //UPLOAD SERVICE PROGRESS
            if($channel->attachment_source || $channel->parent){
                $channel->update(['status'=>'upload']);
                $update = true;
            }
            if($request->has('name') && $request->has('description') ){
                $channel->update([
                    'name'          => strip_tags($request->name),
                    'description'   => filterInput($request->get('description'), 'high')
                ]);
                $update = true;
            }
        }elseif($channel->status=='upload'){
            //SUBMIT / DELETE REQUEST
            if($request->status=='review' && is_admin(auth()->user())!='false'){
                $channel->update(['status'=>'review']);
                $update = true;
            }
        }elseif($channel->status=='publish'){
            // MAKE NEW EDITION CHANNEL
            $data = Channel::create([
                'name'          => strip_tags($request->get('name')),
                'description'   => filterInput($request->get('description'), 'high'),
                'user_id'       => auth()->user()->id,
                'status'        => 'draft',
                'parent_id'     => $channel->id,
            ]);
    
            // $data->project()->create([
            //     'model' => 'channel',
            //     'project_id' => strip_tags($request->get('project')),
            // ]);
    
            $data->category = $channel->project->project->team->categoryTeam->category->id;
            $data->save();
    
            noty('Data channel saved successfully in new draft', 'success');
    
            return redirect()->route('admin.channel.show', [$data->format_id]);
        }else{
            if($request->has('name') && $request->has('description') ){
                $channel->update([
                    'name'          => strip_tags($request->name),
                    'description'   => filterInput($request->get('description'), 'high')
                ]);
                $update = true;
            }
            // event(new ChannelWasUpdated($channel));
        }
        if($update){
            noty('successfully updated channel', 'success');
        }else{
            noty('Terjadi kesalahan', 'warning');
        }

        return redirect()->route('admin.channel.show', [$channel->format_id]);
    }

    public function status(Channel $channel, $status){
        $update = true;
        if($status=='approve'){
            abort_unless(\Gate::allows("AUDIT CHANNEL"), 403);
            $channel->setApprove();
        }elseif($status=='reject'){
            abort_unless(\Gate::allows("AUDIT CHANNEL"), 403);
            $channel->setReject();
        }elseif($status=='submit'){
            abort_unless(\Gate::allows("UPDATE CHANNEL"), 403);
            $channel->setWaitApproval();
        }elseif($status=='reset'){
            abort_unless(\Gate::allows("UPDATE CHANNEL"), 403);
            if($channel->backup){
                //UPDATE COVER
                if($channel->backup->attachment_source){
                    if($channel->attachment_source){
                        $channel->attachment_source->forceDelete();
                    }
                    $channel->backup->attachment_source->update([
                        'model_id' => $channel->id
                    ]);
                }
                //UPDATE BACKGROUND
                if($channel->backup->background_source){
                    if($channel->background_source){
                        $channel->background_source->forceDelete();
                    }
                    $channel->backup->background_source->update([
                        'model_id' => $channel->id
                    ]);
                }
                //UPDATE BASIC DATA
                $channel->update([
                    'name' => $channel->backup->name,
                    'description' => $channel->backup->description
                ]);

                $channel->backup->forceDelete();
            }
        }elseif($status=='unpublish'){
            if($channel->status=='publish'){
                $channel->setUnpublish();
            }else{
                $update = false;
            }
        }elseif($status=='publish'){
            if($channel->status=='unpublish' && $channel->audit->status == 'approve'){
                $channel->setPublish();
            }else{
                $update = false;
            }
        }else{
            $update = false;
        }
        if($update){
            noty('Data channel saved successfully ', 'success');
        }else{
            noty('Terjadi kesalahan saat meng-update channel', 'warning');
        }

        return redirect()->route('admin.channel.show', [$channel->format_id]);
    }

    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE CHANNEL"), 403);
        Channel::withTrashed()->whereIn('id', $request->id)->restore();
        return response()->json(['result' => 'Berhasil restore data']);
    }
    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("DELETE CHANNEL"), 403);
        $selects = Channel::whereIn('id', $request->id)->get();
        return delete_data($selects, 'soft', 'channel');
    }
    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE CHANNEL"), 403);
        $selects = Channel::whereIn('id', $request->id)->get();
        return delete_data($selects, 'force', 'channel');
    }
}
