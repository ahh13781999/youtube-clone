<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class EditVideo extends Component
{
    public Channel $channel;
    public Video $video;

    protected function rules()
    {
        return [
            'video.title' => ['required','max:255'],
            'video.description' => ['nullable','max:255'],
            'video.visibility' => ['required','in:private,public,unlisted'],
        ];
    }

    public function mount($channel,$video)
    {
        $this->channel = $channel;
        $this->video = $video;
    }

    public function update()
    {
       $this->validate();

       $this->video->update([

        'title' => $this->video->title,
        'visibility' => $this->video->visibility,
        'description' => $this->video->description,

       ]);
       session()->flash('message','Video Updated Successfully!');

    }

    public function render()
    {
        return view('livewire.video.edit-video')->extends('layouts.app');
    }
}
