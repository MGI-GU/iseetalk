<?php

namespace App\Http\Controllers\Web;

use App\Models\Audio;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class TrendingController extends Controller
{
    public function index(Request $request)
    {
        $cat = '';
        if($request->has('cat')){
            $id = Hashids::decode($request->cat)[0];
            $cat = Category::find($id);
        }
        return view('web.trending', compact('cat'));
    }
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $data = Audio::find($id)->category->audios()->paginate(10);
        return response()->json($data);
    }
}
