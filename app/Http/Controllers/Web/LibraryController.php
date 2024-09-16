<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class LibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $user = get_user();
        return view('web.library', compact('user'));
    }
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $data = Audio::find($id)->category->audios()->paginate(10);
        return response()->json($data);
    }
}
