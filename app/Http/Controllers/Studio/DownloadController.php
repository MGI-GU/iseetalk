<?php

namespace App\Http\Controllers\Studio;

use Auth;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

class DownloadController extends Controller
{
    public function show(Request $request, $id)
    {
        //return $id;
        $id = Hashids::decode($id)[0];
        $data = Attachment::find($id);
        if($data->user_id==get_user()->id){
            if($data->type=='audio_file'){
                return redirect(Storage::disk('s3')->temporaryUrl(
                    $data->url,
                    now()->addHour(),
                    ['ResponseContentDisposition' => 'attachment']
                ));
            }

            if($data->type=='attachment'){
                
            }
        }
    }

}
