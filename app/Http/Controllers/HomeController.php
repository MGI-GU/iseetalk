<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audio;
use App\Http\Resources\AudioListCollection;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Audio::orderBy('updated_at', 'desc')->showPublic()->paginate(6);
            try {
                return new AudioListCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
        } 
        return view('web.index');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function frontIndex(Request $request)
    {
        return view('web.front_web');
    }
}
