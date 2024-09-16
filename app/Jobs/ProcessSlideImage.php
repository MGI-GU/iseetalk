<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use \ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadAttachment;

class ProcessSlideImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attachment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ConvertApi::setApiSecret(env('CONVERT_SECRET'));
        $result = ConvertApi::convert('jpg', [
            'File' => get_attachment($this->attachment),
            'FileName' => 'slide-'.$this->attachment->id,
            ], $this->attachment->type_data
        );

        // if(env('APP_ENV')=='dev'){
        //     if ( ! Storage::disk('local')->exists(public_path().'/slides/'.$this->attachment->id) ){
        //         Storage::disk('local')->makeDirectory(public_path().'/slides/'.$this->attachment->id);
        //     }
        //     $files = $result->saveFiles(public_path().'/slides/'.$this->attachment->id.'/');
        // }else{
        //     if ( ! Storage::disk('local')->exists($_SERVER['DOCUMENT_ROOT'].'/slides/'.$this->attachment->id) ){
        //         Storage::disk('local')->makeDirectory($_SERVER['DOCUMENT_ROOT'].'/slides/'.$this->attachment->id);
        //     }
        //     $files = $result->saveFiles($_SERVER['DOCUMENT_ROOT'].'/slides/'.$this->attachment->id.'/');
        // }
        if($result){
            $files = $result->response['Files'];
            foreach ($files as $key => $file) {
                UploadAttachment::dispatch($this->attachment, $file, $key);
                // unlink($file);
            }
        }
    }
}
