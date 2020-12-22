<?php

namespace App\Jobs\Videos;

use FFMpeg;
use App\Video;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateVideoThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        FFMpeg::fromDisk('local')
            ->open($this->video->path)
            ->getFrameFromSeconds(1) // This is going to get frame from the specific seconds
            ->export()
            ->toDisk('local')
            ->save("public/thumbnails/{$this->video->id}.png");

            $this->video->update([
                //'thumbnail' => "public/thumbnails/{$this->video->id}.png" //umesto ovog koristimo ovo ispod
                'thumbnail' => Storage::url("public/thumbnails/{$this->video->id}.png")
            ]);
    }
}
