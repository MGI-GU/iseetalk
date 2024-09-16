<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $folderName;
    public $fileName;
    // public $content;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($folderName, $fileName)
    {
        $this->folderName = $folderName;
        // $this->content = $content;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = Storage::disk('local')->get('public/'.$this->folderName.$this->fileName);
        Storage::disk('s3')->put($this->folderName.$this->fileName, $content);
        Storage::delete('public/'.$this->folderName.$this->fileName);
    }
}
