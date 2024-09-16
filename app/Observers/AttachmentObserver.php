<?php

namespace App\Observers;

use App\Models\Attachment;
use \ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessSlideImage;
use App\Jobs\UploadAttachment;

class AttachmentObserver
{
    /**
     * Handle the audio "created" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function created(Attachment $attachment)
    {
        if($attachment->type_data=='pdf'){
            // $this->pdftoImage($attachment);
            ProcessSlideImage::dispatch($attachment);
        }elseif($attachment->type_data=='pptx' || $attachment->type_data=='ppt'){
            // $this->presentationToImage($attachment);
            ProcessSlideImage::dispatch($attachment);
        }elseif($attachment->type=='attachment'){
            $attachment->image()->create([
                'attachment_id' => $attachment->id,
                'title' => $attachment->url,
                'source' => $attachment->url,
                'audio_id' => $attachment->model_id
            ]);
        }
    }

    /**
     * Handle the audio "updated" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function updated(Attachment $attachment)
    {
        if($attachment->type_data=='pdf'){
            if($attachment->image){
                foreach ($attachment->image as $image){
                    Storage::disk('s3')->delete($image->source);
                    $image->delete();
                }
            }
            $this->pdftoImage($attachment);
        }elseif($attachment->type_data=='pptx' || $attachment->type_data=='ppt'){
            if($attachment->image){
                foreach ($attachment->image as $image){
                    Storage::disk('s3')->delete($image->source);
                    $image->delete();
                }
            }
            $this->presentationToImage($attachment);
        }
    }

    /**
     * Handle the audio "deleted" event.
     *
     * @param  \App\Audio  $audio
     * @return void
     */
    public function deleted(Attachment $attachment)
    {
        //
    }

    /**
     * Handle the attachment "restored" event.
     *
     * @param  \App\attachment  $attachment
     * @return void
     */
    public function restored(Attachment $attachment)
    {
        //
    }

    /**
     * Handle the attachment "force deleted" event.
     *
     * @param  \App\attachment  $attachment
     * @return void
     */
    public function forceDeleted(Attachment $attachment)
    {
        //REMOVE FILE
        if(Storage::disk('s3')->exists($attachment->url)) {
            Storage::disk('s3')->delete($attachment->url);
        }
    }

    private function pdftoImage($attachment)
    {
        ConvertApi::setApiSecret(env('CONVERT_SECRET'));
        $result = ConvertApi::convert('jpg', [
                'File' => get_attachment($attachment),
                'FileName' => 'slide-'.$attachment->id,
            ], 'pdf'
        );
        if(env('APP_ENV')=='dev'){
            $files = $result->saveFiles(public_path().'/slides/');
        }else{
            $files = $result->saveFiles($_SERVER['DOCUMENT_ROOT'].'/slides/');
        }

        foreach ($files as $key => $file) {
            $name = 'page-'.$key.'.jpg';
            //save to image
            $attachment->image()->create([
                'attachment_id' => $attachment->id,
                'title' => $key,
                'source' => 'pankord/slides/'.$attachment->id.'/'.$name,
                'audio_id' => $attachment->model_id
            ]);
            Storage::disk('s3')->put('pankord/slides/'.$attachment->id.'/'.$name, file_get_contents($file));
        }

    }
    private function presentationToImage($attachment)
    {
        ConvertApi::setApiSecret(env('CONVERT_SECRET'));
        $result = ConvertApi::convert('jpg', [
            'File' => get_attachment($attachment),
            'FileName' => 'slide-'.$attachment->id,
            ], $attachment->type_data
        );
        if(env('APP_ENV')=='dev'){
            $files = $result->saveFiles(public_path().'/slides/');
        }else{
            $files = $result->saveFiles($_SERVER['DOCUMENT_ROOT'].'/slides/');
        }
        
        foreach ($files as $key => $file) {
            $name = 'page-'.$key.'.jpg';
            //save to image
            $attachment->image()->create([
                'attachment_id' => $attachment->id,
                'title' => $key,
                'source' => 'pankord/slides/'.$attachment->id.'/'.$name,
                'audio_id' => $attachment->model_id
            ]);
            Storage::disk('s3')->put('pankord/slides/'.$attachment->id.'/'.$name, file_get_contents($file));
        }
    }
    private function deleteImageSlide($attachment){
        //FIND ATTACHMENT
        //$delete_attachment = Attachment::where()
        //FIND IMAGE
        //DELETE ALL
        if($attachment->image){
            foreach ($attachment->image as $image){
                Storage::disk('s3')->delete($image->source);
                $image->delete();
            }
        }
    }
}
