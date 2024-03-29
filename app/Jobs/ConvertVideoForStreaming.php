<?php

namespace App\Jobs;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $video;

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
        $destination = '/'.$this->video->uid.'/'.$this->video->uid.'.m3u8';

        $low = (new X264('aac'))->setKiloBitrate(500);
        $high = (new X264('aac'))->setKiloBitrate(1000);
  
  
        $media = FFMpeg::fromDisk('videos-tmp')
        ->open($this->video->path)
        ->exportForHLS()
        ->addFormat($low, function($filters){
            $filters->resize(640, 480);
        })
        ->addFormat($high, function($filters){
          $filters->resize(1280, 720);
        })
        ->onProgress(function($progress){
            $this->video->update([

                  'processing_percentage' => $progress
            
                ]);
        })
        ->toDisk('videos')
        ->save($destination);
        
        $seconds = $media->getDurationInSeconds();
        // delete temp file

        Storage::disk('videos-tmp')->delete('/'.$this->video->path);
           
        $this->video->update([

            'processed' => true,
            'processed_file' => $this->video->uid.'.m3u8',
            'duration' => $this->formatDuration($seconds),
        ]);
    }

    public function formatDuration($seconds)
    {
        $duration = gmdate('H:i:s',$seconds);
        return $duration;
    }
}
