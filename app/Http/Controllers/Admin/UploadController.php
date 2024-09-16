<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return 1;
    }

    public function store(UploadRequest $request){
        // return $request->all();

        $file = $request->file('file');
        $folderName = $request->model.'/'.date('Y').'/';
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Storage::disk('s3')->put($folderName.$fileName, file_get_contents($file));
		
        //define status for image
        $request->merge([
            'type' => $request->type,
            'type_data' => $file->getClientOriginalExtension(),
            'model' => $request->model,
            'model_id' => $request->id,
            'status' => 1,
            'user_id' => auth()->user()->id,
            'size' => $file->getSize(),
            'url' => $folderName.$fileName,
        ]);;
        
        $attach = Attachment::create($request->only('url', 'model', 'model_id','status','size','user_id', 'type', 'type_data'));

		if( $attach ) {    
			$result = array();
			$result['file'] = $fileName;
			$result['slug'] = $attach->slug_id;
			$result['message'] = trans('message.success.create',array('obj'=> 'file'));
			return \Response::json($result, 200); 
		}
        return \Response::json('error', 400);
		
    }

    public function update(UploadRequest $request, $id){

        $file = $request->file('file');
        $folderName = $request->model.'/'.date('Y').'/';
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Storage::disk('s3')->put($folderName.$fileName, file_get_contents($file));

        $attach = Attachment::find($id);
        //delete old file
        Storage::disk('s3')->delete($attach->url);

        //define status for image
        $request->merge([
            'type_data' => $file->getClientOriginalExtension(),
            'status' => 1,
            'user_id' => auth()->user()->id,
            'size' => $file->getSize(),
            'url' => $folderName.$fileName,
        ]);;
        $attach->update($request->only('url', 'model', 'model_id','status','size','user_id'));

		if( $attach ) {    
			$result = array();
			$result['file'] = $fileName;
			$result['message'] = trans('message.success.create',array('obj'=> 'file'));
			return \Response::json($result, 200); 
		}
        return \Response::json('error', 400);
		
    }
}
