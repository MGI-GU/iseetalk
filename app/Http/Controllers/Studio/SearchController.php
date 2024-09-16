<?php

namespace App\Http\Controllers\Studio;

use Auth;
use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class SearchController extends Controller
{
    public function show(Request $request, $id=null)
    {
        if($request->exists('keyword')){
            return redirect()->route('studio.search.show', [str_replace(" ", "+", $request->keyword)]);
        }
        if($request->ajax()) {
            // FIND AUDIO BY KEYWORD
            $audio = Audio::where('user_id', get_user()->id)->where(function ($q) use ($id) {
                $q->where('name','like','%'.$id.'%')->orWhere('description','like','%'.$id.'%');
            })->paginate(5);

            //$audio = Audio::where()->paginate(5);
            return response()->json($audio);
        }
        $id = str_replace("+", " ", $request->keyword);
        return view('studio.result', compact('id'));
    }

}
