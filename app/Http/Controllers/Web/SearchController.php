<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Audio;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\AudioListCollection;

class SearchController extends Controller
{
    public function show(Request $request, $keyword=null)
    {
        if($request->keyword==null){
            return redirect('/');
        }
        if($request->exists('keyword')){
            return redirect()->route('web.search.show', [str_replace(" ", "+", $request->keyword)]);
        }
        $keyword = strip_tags($keyword);
        if($request->ajax()) {
            $keywords = explode("+", $keyword); //str_replace("+", " ", $request->keyword);
            // FIND AUDIO BY KEYWORD
            $audio = Audio::where(function ($q) use ($keywords) {
                foreach($keywords as $keyword){
                    $q->orWhere('name','like','%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%');
                }
            })->showPublic()->paginate(5);
            $audio = $audio->sortByDesc('play_number');

            try {
                return new AudioListCollection($audio);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($audio);
        }
        $id = str_replace("+", " ", $request->keyword);
        $channel = Channel::where(function ($q) use ($keyword) {
            $q->where('name','like','%'.$keyword.'%');
        })->show()->first();
        return view('web.result', compact('id','channel'));
    }
    
    public function tag(Request $request, $keyword=null)
    {
        if($keyword==null){
            return redirect('/');
        }
        $channel = "";
        $keyword = strip_tags($keyword);
        if($request->ajax()) {
            $keywords = explode("+", $keyword); //str_replace("+", " ", $request->keyword);
            // FIND AUDIO BY KEYWORD
            $audio = Audio::with('tags')->whereHas('tags', function ($q) use ($keywords) {
                foreach($keywords as $keyword){
                    $q->where('name','like','%'.$keyword.'%');
                }
            })->showPublic()->paginate(5);
            $audio = $audio->sortByDesc('play_number');

            try {
                return new AudioListCollection($audio);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return response()->json($audio);
        }
        $id = str_replace("+", " ", $request->keyword);
        return view('web.result', compact('id','channel'));
    }

}
