<?php

namespace App\Http\Controllers\Studio;

use App\Models\Audio;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert;
use Vinkla\Hashids\Facades\Hashids;
use App\Events\CommentWasCreated;
use App\Events\CommentWasReplyed;
use App\Http\Resources\CommentCollection;

class CommentController extends Controller
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
        if($request->ajax()) {

            $id = auth()->user()->id;
			$data = Comment::with(['audio', 'user'])->whereHas('audio', function($q) use($id) {
                $q->where('user_id', $id);
            })->orderBy('updated_at', 'desc');
            if($request->has('filter')){
                if($request->filter=='public'){
                    $data = $data->where('status', 'public');
                }elseif($request->filter=='waiting'){
                    $data = $data->where('status', 'review');
                }elseif($request->filter=='publish'){
                    $data = $data->where('status', 'publish');
                }elseif($request->filter=='spam'){
                    $data = $data->whereIn('status', ['spam', '']);
                }
            }
            $data = $data->get();
            try {
                return new CommentCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('studio.comment');
    }

    public function create()
    {
        return view('studio.comment.comment-add');
    }

    public function store(Request $request, Audio $audio)
    {
        $comment = $audio->comments()->create([
            'comment' => strip_tags($request->comment),
            'comment_id' => ($request->comment_id?strip_tags($request->comment_id):NULL),
            'user_id' => auth()->user()->id,
            'status' => 'publish'
        ]);

        $reply_comment = Comment::find($request->comment_id);
        $reply_comment->status = 'publish';
        $reply_comment->save();
        
        if($comment->comment_id !== null){
            event(new CommentWasReplyed($comment));
        }else{
            event(new CommentWasCreated($comment));
        }

        noty('Data saved successfully comment', 'success');

        return redirect()->route('studio.audio.comment', [$audio->slug]);
    }

    public function show(Request $request, $audio){
        $id = Hashids::decode($audio)[0];
        $audio = Audio::where('id', $id)->where('user_id', get_user()->id)->first();
		if($request->ajax()) {
            $data = Audio::find($id)->comments()->with('comments')->where('comment_id', null)->orderBy('created_at', 'desc')->paginate(2);
            return response()->json($data);
        }
        return view('studio.audio_comment', compact('audio'));
    }

    public function edit(Comment $comment)
    {
        return view('studio.comment-detail', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->permission()->detach();
        foreach ($request->get('permission') as $key => $value) {
            $comment->permission()->attach($value);
        }
        noty('successfully updated comment', 'success');
        return redirect('studio/comment/'.$comment->id);
    }

    public function publish(Request $request)
    {
        $selects = Comment::whereIn('id', $request->id)->get();
        foreach($selects as $comment){
            $comment->status = 'publish';
            $comment->save();
        }
        return response()->json(['result' => 'Berhasil publish data']);
    }

    public function delete(Request $request)
    {
        //FORCE DELETE
        $selects = Comment::whereIn('id', $request->id)->get();
        foreach($selects as $select){
            $select->setDelete();
        }
        return delete_data($selects);
    }

    public function destroy(Comment $comment)
    {
        if(!$comment || $comment->audio->user_id != auth()->id()){
            noty('Unauthorize', 'danger');
            return redirect()->back();
        }
        $comment->setSpam();
        noty('Berhasil menghapus audio, klik untuk membatalkan', 'information');

        return redirect()->back();
    }
}
