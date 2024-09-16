<?php

namespace App\Http\Controllers\Studio;

use UxWeb\SweetAlert\SweetAlert;
use App\Models\Image;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessSlideImage;

class SlideController extends Controller
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
		//
    }

    public function create(Request $request, Attachment $attachment)
    {
        if($attachment->image->count()>0){
            if($attachment->image){
                foreach ($attachment->image as $image){
                    if(Storage::disk('s3')->exists($image->source)) {
                        Storage::disk('s3')->delete($image->source);
                    }
                    $image->delete();
                }
            }
        }

        ProcessSlideImage::dispatch($attachment);
        SweetAlert::success('Proses recreate data slide...');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
			$data = Image::find($request->id);
            return $data->toJson();
        }
    }

    public function copy(Request $request){
        $selects = Image::whereIn('id', $request->id)->get();
        foreach($selects as $key => $slide){
            $duplicate = new Image;
            $duplicate->attachment_id = $slide->attachment_id;
            $duplicate->title = 'copy '.$slide->title;
            $duplicate->source = $slide->source;
            $duplicate->audio_id = $slide->audio_id;
            $duplicate->status = 'copy';
            $duplicate->save();
        }
        if($request->ajax()) {
            return response()->json(['result' => 'Berhasil duplicate slide']);
        }
        return redirect()->back();
    }

    public function show(Request $request, Audio $audio)
    {
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
    }

    public function edit(Request $request, Image $slide)
    {
        //
    }

    public function update(Request $request, Image $slide)
    {
        //UPLOAD SERVICE PROGRESS
        $update = $slide->update([
            'title'=> strip_tags($request->get('title')),
            'time_show'=> strip_tags($request->get('time_show')),
            'time_end'=> strip_tags($request->get('time_end')),
        ]);

        if($update){
            SweetAlert::success('successfully updated Slide audio');
        }else{
            SweetAlert::warning('Terjadi kesalahan saat meng-update slide audio');
        }

        return redirect()->back();
    }

    public function replace(Request $request){
        $draft = Image::find(strip_tags($request->draft));
        $active = Image::find(strip_tags($request->active));
        // SET DRAVE SLIDE TO ACTIVE SLIDE
        // return $active[0];
        return $this->swap($draft, $active);
    }

    private function swap($s1, $s2){
        $old_show = $s1->time_show;
        $old_end = $s1->time_end;

        $s1->time_show = $s2->time_show;
        $s1->time_end = $s2->time_end;
        $s1->save();

        $s2->time_show = $old_show;
        $s2->time_end = $old_end;
        $s2->save();

        return response()->json(['result' => 'Berhasil restore data']);
    }

    //SET TIME BY PAUSE AUDIO
    public function setup(Request $request)
    {
        // return $request->all();
        $data = Image::find(strip_tags($request->slide));
        // return $request;
        if($request->has('type') && $request->type=='first'){
            $request_time = 0;
            $active_1st = Image::where('audio_id', $data->audio_id)->where('time_show', 0)->where('time_end', '>', 0)->first();
            if($active_1st){
                return $this->swap($data, $active_1st);
            }
        }else{
            $request_time = $request->time;
            $prev = prev_slide($data, $request_time);
            //LOGIC TIME IS HIGHER
            // SET START TIME WIHT REQUEST VALUE AND UPDATE PREV SLIDE END TIME WITH REQUEST VALUE - 1
            // UPDATE PREV END TIME
            if($prev){
                $prev->time_end = $request->time-1;
                $prev->save();
            }
        }
        $next = next_slide($data, $request_time);
        
        //LOGIC TIME IS LOWER
        // SET START TIME WITH REQUEST VALUE AND SET END TIME WITH START TIME NEXT SLIDE -1
        // GET END TIME VALUE
        if($next){
            $data->time_end = $next->time_show-1;
        }else{
            $data->time_end = $data->audio->duration;
        }
        
        
        //save slide setup
        $data->time_show = $request->time;
        $data->save();
        if($request->ajax()) {
            return response()->json(['result' => 'Berhasil update data slide']);
        }
        return redirect()->back();
    }

    public function draft(Request $request)
    {
        $selects = Image::whereIn('id',($request->id)->get();
        foreach($selects as $slide){
            $prev = prev_slide($slide);
            if($prev){
                $prev->time_end = $slide->time_end;
                $prev->save();
            }

            $slide->setDraft();

        }
        return response()->json(['result' => 'Berhasil remove data']);
    }

    public function restore(Request $request)
    {
        Image::onlyTrashed()->whereIn('id', strip_tags($request->id))->restore();
        return response()->json(['result' => 'Berhasil restore data']);
    }

    public function delete(Request $request)
    {
        if($request->filter == 'deleted'){
            //FORCE DELETE
            $selects = Image::onlyTrashed()->whereIn('id', $request->id)->get();
            return delete_data($selects, 'force');
        }
        //SOFT DELETE
        $selects = Image::whereIn('id', $request->id)->get();
        return delete_data($selects);
        return redirect()->back();
    }

    public function destroy(Attachment $attachment)
    {
        // Storage::disk('s3')->delete($request->source);
        // delete_data($request, 'force');
        // return $attachment;
        //FORCE DELETE
        $attachment->forceDelete();
        // return delete_data($attachment, 'force');
        SweetAlert::success('successfully deleted Attachment Slide');

        return redirect()->back();
    }

    public function refresh(Attachment $attachment){
        foreach ($attachment->image as $key => $image){
            Storage::disk('s3')->put($image->source, file_get_contents($image->pages));
        }
        SweetAlert::success('Proses recreate data slide...');
        return redirect()->back();
    }
}
