<?php

namespace App\Http\Controllers\Admin;

use UxWeb\SweetAlert\SweetAlert;
use Analytics;
use App\Models\Tag;
use App\Models\Audio;
use App\Models\Playlist;
use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Http\Controllers\Controller;
use App\Http\Resources\AudioCollection;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\Admin\AudioRequest;

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
        //FILTER CONTENT TEAM HERE
    }

    public function index(Request $request)
	{
        abort_unless(\Gate::allows("VIEW AUDIO"), 403);
		if($request->ajax()) {
            $filter = [];
            // $data = Audio::orderBy('id', 'desc');
            if($request->has('filter')){
                if($request->filter=='inhouse'){
                    $filter = ['inhouse' => strip_tags($request->filter)];
                    // $data = $data->has('project');
                }elseif($request->filter=='upload'){
                    $filter = ['upload' => strip_tags($request->filter)];
                    // $data = $data->doesnthave('project');
                }elseif($request->filter=='deleted'){
                    $filter = ['deleted' => strip_tags($request->filter)];
                    // $data = $data->onlyTrashed();
                }elseif($request->filter=='all'){
                    $filter = ['all' => strip_tags($request->filter)];
                }elseif($request->filter=='draft'){
                    $filter = ['status' => strip_tags($request->filter)];
                }elseif($request->filter=='review'){
                    $filter = ['status' => strip_tags($request->filter)];
                }elseif($request->filter=='publish'){
                    $filter = ['status' => strip_tags($request->filter)];
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
            $data = get_own_audio($filter);//$data->get();
            try {
                //return new AudioResource($data);
                $collection = new AudioCollection($data);
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
        return view('admin.audio.audio');
    }

    public function create(Request $request)
    {
        abort_unless(\Gate::allows("CREATE AUDIO"), 403);
        return view('admin.audio.audio-add', compact('request'));
    }

    public function store(AudioRequest $request)
    {
        abort_unless(\Gate::allows("CREATE AUDIO"), 403);
        $allow_comment = ($request->has('allow_comment') ? strip_tags($request->get('allow_comment')):0);
        $allow_rating = ($request->has('allow_rating') ? 1:0);
        $allow_age = ($request->has('allow_age') ? 1:0);
        $sort_comment = ($request->has('sort_comment') ? 1:0);
        $contain = ($request->has('contain') ? 1:0);
        $allow_notice = ($request->has('allow_notice') ? 1:0);
        $data = Audio::create([
            'name'          => strip_tags($request->get('name')),
            'description'   => filterInput($request->get('description'), 'high'),
            'allow_comment' => $allow_comment,
            'sort_comment'  => $sort_comment,
            'allow_notice'  => $allow_notice,
            'allow_rating'  => $allow_rating,
            'allow_age'     => $allow_age,
            'contain'       => $contain,
            'channel_id'    => strip_tags($request->get('channel')),
            'user_id'       => auth()->user()->id,
        ]);
        
        $data->project()->create([
            'model' => 'audio',
            'model_id' => $data->id,
            'project_id' => $data->channel->project->project_id,
            'source' => strip_tags($request->get('source')),
            'status' => 'step1',
            'note' => strip_tags($request->get('note')),
            'weblink' => $request->has('url') && $request->get('url')!='' ? strip_tags($request->get('url')) : NULL,
        ]);

        noty('Data saved successfully', 'success');

        return redirect()->route('admin.audio.show', [$data->format_id]);
    }

    public function show(Request $request, $audio)
    {
        abort_unless(\Gate::allows("VIEW AUDIO"), 403);
        $id = Hashids::connection('audioslide')->decode($audio)[0];
        $audio = Audio::find($id);
        if(auth()->user()->type!='admin' && @$audio->channel->project){
            abort_unless(in_array(auth()->user()->id, get_team_user($audio->channel->project->project->team_id)->toArray()), 403);
        }elseif(!@$audio->channel->project){
            abort_unless(auth()->user()->type=='admin', 403);
        }
        if(@$audio->project){
            // return $audio->project;
            if($audio->project->status=='step1'){
                return view('admin.audio.audio-add-write', compact('audio'));
            }elseif($audio->project->status=='step2'){
                return view('admin.audio.audio-add-audio', compact('audio'));
            }elseif($audio->project->status=='step3'){
                if($request->ajax()) {
                    return $this->getSlide($request, $audio);
                }
                return view('admin.audio.audio-add-slide', compact('audio'));
            }elseif($audio->project->status=='step4'){
                return view('admin.audio.audio-add-design', compact('audio'));
            }elseif($audio->project->status=='step5'){
                return view('admin.audio.audio-review', compact('audio'));
            }
        }
        return view('admin.audio.audio-detail', compact('audio'));
    }

    public function edit(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
        if(auth()->user()->type!='admin' && @$audio->channel->project){
            abort_unless(in_array(auth()->user()->id, get_team_user($audio->channel->project->project->team_id)->toArray()), 403);
        }elseif(!@$audio->channel->project){
            abort_unless(auth()->user()->type=='admin', 403);
        }
        return view('admin.audio.audio-edit', compact('audio'));
    }

    public function analytic(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("VIEW AUDIO"), 403);
        if(auth()->user()->type!='admin' && @$audio->channel->project){
            abort_unless(in_array(auth()->user()->id, get_team_user($audio->channel->project->project->team_id)->toArray()), 403);
        }elseif(!@$audio->channel->project){
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
                    'filters' => 'ga:pagePath=~listen/'.$audio->slug
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
        return view('admin.audio.audio-analytic', compact('audio'));
    }
    
    public function comment(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("VIEW AUDIO"), 403);
        if($request->ajax()) {
            abort_unless(\Gate::allows("VIEW COMMENT"), 403);
            $data = Audio::find($audio->id)->show_comments()->with('comments')->where('comment_id', null)->orderBy('created_at', 'desc')->paginate(2);
            return response()->json($data);
        }
        return view('admin.audio.audio-comment', compact('audio'));
    }

    public function audit(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("VIEW AUDIO"), 403);
        return view('admin.audio.audio-audit', compact('audio'));
    }

    public function slide(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("VIEW AUDIO"), 403);
        if($request->ajax()) {
            return $this->getSlide($request, $audio);
        }
        return view('admin.audio.audio-add-slide', compact('audio'));
    }

    private function getSlide($request, $audio){
        // abort_unless(\Gate::allows("VIEW SLIDE"), 403);
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

    public function update(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
        $update = false;
        if($audio->project && $audio->project->status=='step1'){
            //UPLOAD SERVICE PROGRESS
            if($request->has('next') && $request->get('next')=='next'){
                $audio->project->update([
                    'status'=>'step2'
                ]);
            }elseif($request->has('save') && $request->get('save')=='setting'){
                //buatkan function private untuk pengulangan pemanggilan function
                $this->updateSetting($audio, $request);

                $audio->project->update([
                    'source' => strip_tags($request->get('source')),
                    'weblink' => strip_tags($request->get('url')),
                    'note' => strip_tags($request->get('note')),
                ]);
            }else{
                $audio->update([
                    'name'=> strip_tags($request->get('name')),
                    'description'=> filterInput($request->get('description'), 'high'),
                    'language'=> strip_tags($request->get('language')),
                ]);
            }
            $update = true;
        }elseif($audio->project && $audio->project->status=='step2'){
            //UPLOAD ATTACHMENT AUDIO
            $audio->update(['duration' => $request->get('duration')]);
            if($audio->audio_source || ($audio->parent && $audio->parent->audio_source)){
                if($request->has('save') && $request->get('save')=='next'){
                    $audio->project->update([
                        'status'=>'step3'
                    ]);
                }
                $update = true;
            }
        }elseif($audio->project && $audio->project->status=='step3'){
            //UPLOAD SLIDE 
            if($audio->first_slide){
                $audio->update(['contain' => 1]);
                if($request->has('save') && $request->get('save')=='next'){
                    $audio->project->update([
                        'status'=>'step4'
                    ]);
                }
                $update = true;
            }
        }elseif($audio->project && $audio->project->status=='step4'){
            //UPLOAD ATTACHMENT COVER
            if($audio->contain == 'reject-slide'){
                $audio->project->update([
                    'status'=>'step3'
                ]);
            }
            if($audio->cover_source || $audio->parent->cover_source){
                if($audio->contain == 'approve-slide'){
                    $audio->project->update([
                        'status'=>'step5'
                    ]);
                }
            }
            $update = true;
        }elseif($audio->project && $audio->project->status=='step5' && is_leader(auth()->user())=='false'){
            if($request->has('progress_status')){
                $audio->project->update([
                    'status'=> $request->get('progress_status')
                ]);
            }
            $update = true;
        }elseif($audio->status=='publish' && is_leader(auth()->user())!='false'){
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
                    'description'   => filterInput($request->get('description'), 'high'),
                    'user_id'       => auth()->user()->id,
                    'status'        => 'draft',
                    'parent_id'     => $audio->id,
                    'duration'      => $audio->duration,
                    'visibility'    => $audio->visibility,
                    'allow_comment' => $request->allow_comment,
                    'sort_comment'  => $request->sort_comment,
                    'allow_notice'  => $request->allow_notice,
                    'allow_rating'  => $request->allow_rating,
                    'allow_age'     => $request->allow_age,
                    'contain'       => $audio->contain,
                    'channel_id'    => $audio->channel_id,
                    'language'      => $request->has('language') && $request->get('language')!='' ? strip_tags($request->get('language')) : 'none'
                ]);
        
                $data->save();

                $data->project()->create([
                    'model' => 'audio',
                    'model_id' => $data->id,
                    'source' => strip_tags($request->get('source')),
                    'status' => 'step1'
                ]);

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
    
            return redirect()->route('admin.audio.show', [$data->format_id]);
        }else{
            $allow_comment = ($request->has('allow_comment') ? strip_tags($request->get('allow_comment')):0);
            $allow_rating = ($request->has('allow_rating') ? 1:0);
            $allow_age = ($request->has('allow_age') ? 1:0);
            $sort_comment = ($request->has('sort_comment') ? 1:0);

            $request->request->add(['allow_comment' => $allow_comment]);
            $request->request->add(['allow_rating' => $allow_rating]);
            $request->request->add(['allow_age' => $allow_age]);
            $request->request->add(['sort_comment' => $sort_comment]);

            if($request->has('progress_status')){
                $audio->project->update([
                    'status'=> strip_tags($request->get('progress_status'))
                ]);
            }
            if($request->has('approval_status')){
                $request->request->add(['status' => strip_tags($request->get('approval_status'))]);
            }

            $audio->update($request->all());
            $update = true;
        }
        if($request->has('save') && $request->get('save')!='next'){
            if($request->has('progress_status')){
                $audio->project->update([
                    'status'=> strip_tags($request->get('progress_status'))
                ]);
            }
        }
        if($update){
            noty('Data audioslide saved successfully', 'success');
        }else{
            noty('Terjadi kesalahan saat meng-update audio', 'warning');
        }

        return redirect()->route('admin.audio.show', [$audio->format_id]);
    }

    private function updateSetting($audio, $request){
        $allow_comment = ($request->has('allow_comment') ? strip_tags($request->get('allow_comment')):0);
        $allow_rating = ($request->has('allow_rating') ? strip_tags($request->get('allow_rating')):0);
        $allow_age = ($request->has('allow_age') ? strip_tags($request->get('allow_age')):0);
        $allow_notice = ($request->has('allow_notice') ? strip_tags($request->get('allow_notice')):0);
        $sort_comment = ($request->has('sort_comment') ? strip_tags($request->get('sort_comment')):0);

        $request->request->add(['allow_comment' => $allow_comment]);
        $request->request->add(['allow_rating' => $allow_rating]);
        $request->request->add(['allow_age' => $allow_age]);
        $request->request->add(['allow_notice' => $allow_notice]);
        $request->request->add(['sort_comment' => $sort_comment]);

        $audio->update([
            'allow_comment'=> strip_tags($request->get('allow_comment')),
            'allow_rating'=> strip_tags($request->get('allow_rating')),
            'allow_age'=> strip_tags($request->get('allow_age')),
            'allow_notice'=> strip_tags($request->get('allow_notice')),
            'sort_comment'=> strip_tags($request->get('sort_comment')),
        ]);
    }

    public function status(Audio $audio, $status){
        $update = true;
        if($status=='approve'){
            abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
            $audio->project->update([
                'status'=> 'complete'
            ]);
        }elseif($status=='reject'){
            abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
            $audio->project->update([
                'status'=> 'step1'
            ]);
        }elseif($status=='submit'){
            abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
            $audio->setWaitApproval();
        }elseif($status=='revoke'){
            abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
            $audio->project->update([
                'status'=> 'step1'
            ]);
            $audio->setRevoke();
        }elseif($status=='reset'){
            abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
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
        }elseif($status=='unpublish'){
            if($audio->status=='publish'){
                $audio->setUnpublish();
            }else{
                $update = false;
            }
        }elseif($status=='publish'){
            if($audio->status=='unpublish' && $audio->audit->status == 'approve'){
                $audio->setPublish();
            }else{
                $update = false;
            }
        }elseif($status=='step1' && ($audio->status=='draft' || $audio->status=='review')){
            $audio->project->update([
                'status'=> 'step1'
            ]);
        }elseif($status=='step2' && ($audio->status=='draft' || $audio->status=='review')){
            $audio->project->update([
                'status'=> 'step2'
            ]);
        }elseif($status=='step3' && ($audio->status=='draft' || $audio->status=='review')){
            $audio->project->update([
                'status'=> 'step3'
            ]);
        }elseif($status=='step4' && ($audio->status=='draft' || $audio->status=='review')){
            $audio->project->update([
                'status'=> 'step4'
            ]);
        }else{
            $update = false;
        }
        if($update){
            noty('Data audioslide saved successfully ', 'success');
        }else{
            noty('Terjadi kesalahan saat meng-update audio', 'warning');
        }

        return redirect()->route('admin.audio.show', [$audio->format_id]);
    }

    public function slideStatus(Request $request, Audio $audio, $status){
        if(is_graphic_design(auth()->user())!=='false'){
            $audio->update(['contain' => $status]);
        }
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
        Audio::onlyTrashed()->whereIn('id', $request->id)->restore();
        return response()->json(['result' => 'Berhasil restore data']);
    }    

    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE AUDIO"), 403);
        
        if($request->filter == 'deleted'){
            //FORCE DELETE
            $selects = Audio::onlyTrashed()->whereIn('id', $request->id)->get();
            return delete_data($selects, 'force');
        }
        //SOFT DELETE
        $selects = Audio::whereIn('id', $request->id)->get();
        return delete_data($selects, 'soft', 'audio');
    }

    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE AUDIO"), 403);
        $selects = Audio::whereIn('id', $request->id)->get();
        return delete_data($selects, 'force', 'audio');
    }
}
