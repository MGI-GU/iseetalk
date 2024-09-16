<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Audio;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        abort_unless(\Gate::allows("VIEW COMMENT"), 403);
		if($request->ajax()) {
            $filter = [];
            // $data = Comment::with('audio', 'user')->orderBy('updated_at', 'desc');
            if($request->has('filter')){
                if($request->filter=='deleted'){
                    $filter = ['deleted' => strip_tags($request->filter)];
                    // $data = $data->onlyTrashed();
                }elseif($request->filter=='upload'){
                    $filter = ['upload' => strip_tags($request->filter)];
                    // $data = $data->whereHas('audio', function($q) {
                    //     $q->doesnthave('project');
                    // });
                }elseif($request->filter=='inhouse'){
                    $filter = ['inhouse' => strip_tags($request->filter)];
                }else{
                    $filter = ['status' => strip_tags($request->filter)];
                    // $data = $data->where('status', $request->filter);
                }
            }
            // else{
            //     $data = $data->whereHas('audio', function($q) {
            //         $q->whereHas('project');
            //     });
            // }
            $data = get_own_audio_comment($filter);//$data->get();
            try {
                return new CommentCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('admin.comment.comment');
    }

    public function create()
    {
        abort_unless(\Gate::allows("CREATE COMMENT"), 403);
        return view('admin.comment.comment-add');
    }

    public function store(Request $request, Audio $audio)
    {
        abort_unless(\Gate::allows("CREATE COMMENT"), 403);
        $comment = $audio->comments()->create([
            'comment' => strip_tags($request->comment),
            'comment_id' => ($request->comment_id?strip_tags($request->comment_id):NULL),
            'status' => 'publish',
            'user_id' => auth()->user()->id
        ]);
        noty('Data saved successfully comment', 'success');
        if($comment->comment_id !== null){
            event(new CommentWasReplyed($comment));
        }else{
            event(new CommentWasCreated($comment));
        }

        return redirect()->route('admin.audio.comment', [$audio->id]);
    }

    public function edit(comment $comment)
    {
        abort_unless(\Gate::allows("UPDATE COMMENT"), 403);
        if(auth()->user()->type!='admin' && @$comment->audio->channel->project){
            abort_unless(in_array(auth()->user()->id, get_team_user($comment->audio->channel->project->project->team_id)->toArray()), 403);
        }elseif(!@$comment->audio->channel->project){
            abort_unless(auth()->user()->type=='admin', 403);
        }
        return view('admin.comment.comment-detail', compact('comment'));
    }

    public function update(Request $request, comment $comment)
    {
        abort_unless(\Gate::allows("UPDATE COMMENT"), 403);
        $comment->permission()->detach();
        foreach ($request->get('permission') as $key => $value) {
            $comment->permission()->attach($value);
        }
        noty('Data saved successfully', 'success');

        return redirect('admin/comment/'.$comment->id);
    }

    public function publish(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE COMMENT"), 403);
        $selects = Comment::whereIn('id', $request->id)->get();
        foreach($selects as $comment){
            $comment->status = 'publish';
            $comment->save();
        }
        return response()->json(['result' => 'Berhasil publish data']);
    }

    public function spam(comment $comment)
    {
        abort_unless(\Gate::allows("UPDATE COMMENT"), 403);
        $comment->setSpam();
        noty('Data saved successfully', 'success');

        return redirect('admin/comment');
    }

    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE COMMENT"), 403);
        $comments = Comment::withTrashed()->whereIn('id', $request->id)->get();
        foreach($comments as $comment){
            $comment->restore();
        }
        return response()->json(['result' => 'Berhasil restore data']);
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("DELETE COMMENT"), 403);
        $selects = Comment::whereIn('id', $request->id)->get();
        foreach($selects as $select){
            $select->setDelete();
        }

        return delete_data($selects);
    }

    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE COMMENT"), 403);
        $selects = Comment::whereIn('id', ($request->id)->get();
        return delete_data($selects, 'force');
    }
}
