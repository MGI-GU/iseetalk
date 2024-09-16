<?php

namespace App\Http\Controllers\Web;

use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Alert;

class AudioController extends Controller
{
    public function show($id)
    {
        $id = Hashids::decode($id)[0];
        $data = Audio::find($id)->category->audios()->paginate(10);
        return response()->json($data);
    }
}
