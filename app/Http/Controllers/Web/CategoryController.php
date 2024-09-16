<?php

namespace App\Http\Controllers\Web;

use App\Models\Audio;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\AudioListCollection;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->cat)
            $id = Hashids::decode($request->cat)[0];

        if($request->ajax()) {
            $data = get_category_audio($id);
            return response()->json($data);
        }
        $cat = '';
        if($request->has('cat')){
            $id = Hashids::decode($request->cat)[0];
            $cat = Category::find($id);
        }
        return view('web.category', compact('cat'));
    }
    public function show($id)
    {
        if($request->ajax()) {
            return 2;
        }
        $id = Hashids::decode($id)[0];
        $data = Audio::find($id)->category->audios()->paginate(10);
        return response()->json($data);
    }
}
