<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadAttachment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attachment;
    public $file;
    public $key;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attachment, $file, $key)
    {
        $this->attachment = $attachment;
        $this->file = $file;
        $this->key = $key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = 'page-'.$this->key.'.jpg';
        //save to image
        $image = $this->attachment->image()->create([
            'attachment_id' => $this->attachment->id,
            'title' => $this->key,
            'source' => 'iseetalk/slides/'.$this->attachment->id.'/'.$name,
            'audio_id' => $this->attachment->model_id,
            'pages' => $this->file['Url']
        ]);
        Storage::disk('s3')->put('iseetalk/slides/'.$this->attachment->id.'/'.$name, file_get_contents($image->pages));
        //unlink($this->file);
    }
}
