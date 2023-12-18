<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class FileUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;
    // protected $path;
    
    /**
     * Create a new job instance.
     */
    public function __construct($image)
    {
        $this->image = $image;
        // $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Perform image upload logic here
        Storage::putFile('public',$this->image);//disk('public')->put($this->path, file_get_contents($this->image));
    }

   

   
}

