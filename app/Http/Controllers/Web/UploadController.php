<?php

namespace App\Http\Controllers\Web;

use Auth;
use UxWeb\SweetAlert\SweetAlert;
use App\Models\Attachment;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Response;
use App\Jobs\UploadContent;
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
        if(auth()->user()->type=="creator" || auth()->user()->type=="member" || auth()->user()->type=="admin"){
            return view('web.upload');
        }
        SweetAlert::success('Please verification your account first. Thanks');
        return redirect('/');
    }

    public function show(Request $request, $id)
    {
        $channel = null;
        if($request->has("ch")){
            $c_id = Hashids::decode($request->ch)[0];
            $channel = Channel::find($c_id);
        }
        $id = Hashids::decode($id)[0];
        $data = Attachment::find($id);
        if($data->audio_upload){
            return redirect('studio/audio/'.$data->audio_upload->slug);
        }
        if($data->model == 'user' && $data->model_id == auth()->user()->id){
            return view('web.upload_step', compact('data', 'channel'));
        }else{
            return view('web.upload');
        }
    }

    public function store(UploadRequest $request){
        // return $request->all();

        $file = $request->file('file');
        $valid = false;
        // GENERATE FOLDER
        // AUDIO USER /audio/{id}/file
        // COVER AUDIO USER /audio/{id}/img/file
        // VISUAL AUDIO USER /audio/{id}/attach/file

        // LOGO CHANNEL /channel/{id}/file
        // BANNER CHANNEL /channel/{id}/file
        // AVATAR user/file_id_user
        $fileName = time().'.'.$file->getClientOriginalExtension();

        if($request->model=='audio' && $request->type=='cover'){
            // /audio/year/{user_id}/img/file
            $folderName = $request->model.'/'.date('Y').'/'.auth()->user()->id.'/';
            $valid = true;
        }elseif($request->model=='user' && $request->type=='audio'){
            // /audio/year/{id}/file
            $folderName = $request->model.'/'.date('Y').'/'.auth()->user()->id.'/';
            $valid = true;
        }elseif($request->model=='audio' && $request->type=='attachment'){
            // /audio/year/{id}/attach/file
            if( in_array( $file->getClientOriginalExtension(),  array('png', 'jpg', 'pptx', 'ppt', 'pdf') )){
                $folderName = $request->model.'/'.date('Y').'/'.auth()->user()->id.'/';
                $valid = true;
            }
        }elseif($request->model=='channel'){
            // /channel/year/{user_id}/file
            $folderName = $request->model.'/'.date('Y').'/'.$request->id.'/';
            $valid = true;
        }else{
            $folderName = $request->model.'/'.date('Y').'/';
            $valid = true;
        }

        if($valid){
            //check and resize image demension
            Storage::disk('local')->put('public/'.$folderName.$fileName, file_get_contents($file));
            // Storage::disk('s3')->put($folderName.$fileName, file_get_contents($file));
            UploadContent::dispatch($folderName, $fileName);
            
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
            ]);
            
            $attach = Attachment::create($request->only('url', 'model', 'model_id','status','size','user_id', 'type', 'type_data'));
    
            if( $attach ) {    
                $result = array();
                $result['file'] = $fileName;
                $result['slug'] = $attach->slug_id;
                $result['message'] = trans('message.success.create',array('obj'=> 'file'));
                return Response::json($result, 200); 
            }
        }
        return Response::json('error', 400);
		
    }

    public function update(UploadRequest $request, $id){
        $file = $request->file('file');
        $folderName = $request->model.'/'.date('Y').'/';
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Storage::disk('local')->put('public/'.$folderName.$fileName, file_get_contents($file));
        // Storage::disk('s3')->put($folderName.$fileName, file_get_contents($file));
        // $content = Storage::disk('local')->get('public/'.$folderName.$fileName);
        UploadContent::dispatch($folderName, $fileName);

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
        $attach->update($request->only('url','status','size','user_id', 'type_data'));

		if( $attach ) {    
			$result = array();
			$result['file'] = $fileName;
			$result['message'] = trans('message.success.create',array('obj'=> 'file'));
			return Response::json($result, 200); 
		}
        return Response::json('error', 400);
		
    }
}
