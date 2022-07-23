<?php

namespace App\Http\Livewire\Video;

use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllVideo extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public function delete(Video $video)
    {
        $this->authorize('delete',$video);

        $deleted = Storage::disk('videos')->deleteDirectory($video->uid);
        
        if($deleted)
        {
            $video->delete();
        }

        return back();
    }

    public function render()
    {
        return view('livewire.video.all-video',
        [
          'videos' => auth()->user()->channel->videos()->paginate(10),

        ])->extends('layouts.app');
    }
}
