<?php

namespace App\Http\Controllers\Web;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class AttachmentController extends Controller
{
    public function show($id)
    {
        $data = Attachment::find($id)->url;
        return response()->file(urlStorage().$data);
    }

    public function download($id)
    {
        $data = Attachment::find($id)->url;
        return response()->download(urlStorage().$data);
    }
}
