<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Events\CommentWasCreated;

class CommentController extends Controller
{
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $data = Audio::find($id)->show_comments()->with('comments')->where('comment_id', null)->orderBy('created_at', 'desc')->paginate(2);
        return response()->json($data);
    }

    public function store(Request $request, $slug)
    {
        if(Auth::check()){
            $id = Hashids::decode($slug)[0];
            $data = Audio::find($id);

            $status = 'public';
            if($data->allow_comment==2 && $data->user_id != auth()->user()->id){
                $status = 'review';
            }
    
            $comment = $data->comments()->create([
                'comment' => strip_tags($request->comment),
                'user_id' => auth()->user()->id,
                'status'  => $status
            ]);

            event(new CommentWasCreated($comment));
            
		    if($request->ajax()) {
                return response()->json([$comment]);
            }
            return redirect()->back();
        }
        return redirect()->route('login', [$slug]);
    }
}
