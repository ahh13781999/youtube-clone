<?php

namespace App\Http\Livewire\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{
    use WithFileUploads;
 
    protected $listeners = ['fileCompleted'];

    public Channel $channel;
    public Video $video;

    public $videoFile;

    protected $rules = [
             
        'videoFile' => ['required','mimes:mp4','max:24000']
    
    ];

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }



    public function upload()
    {
        $this->validate();
    }

    public function fileCompleted()
    {
        $videoPath = $this->videoFile->store('videos-tmp');

        $this->video = $this->channel->videos()->create([

            'title' => 'untitled',

            'description' => 'untitled',

            'uid' => uniqid(true),

            'visibility' => 'private',

            'path' => explode('/',$videoPath)[1],
        ]);

        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);

        return redirect()->route('video.edit',[
               'channel' => $this->channel,
               'video' => $this->video,
        ]);
    }

    public function render()
    {
        return view('livewire.video.create-video')->extends('layouts.app');
    }
}
