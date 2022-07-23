<?php

namespace App\Http\Livewire\Video;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\Video;
use Livewire\Component;

class Voting extends Component
{

    protected $listeners = ['load_values' => '$refresh'];

    public $video;

    public $likes;
    public $dislikes;
    public $likeActive;
    public $dislikeActive;

    public function mount(Video $video)
    {
       $this->video = $video;
       $this->checkIfLiked();
       $this->checkIfDisliked();
    }

    public function checkIfLiked()
    {
       $this->video->doesUserLikedVideo() ? $this->likeActive = true : $this->dislikeActive = false;
    }

    public function checkIfDisliked()
    {
       $this->video->doesUserDislikedVideo() ? $this->dislikeActive = true : $this->likeActive = false;
    }

    public function like()
    {
        if($this->video->doesUserLikedVideo())
        {
           Like::whereUserId(auth()->id())->whereVideoId($this->video->id)->delete();
           $this->likeActive = false;
        }
        else
        {
        $this->video->likes()->create([

         'user_id' => auth()->id(),

        ]);
        $this->disableDislike();
        $this->likeActive = true;
        }
        $this->emit('load_values');
    }

    public function dislike()
    {
        if($this->video->doesUserDislikedVideo())
        {
            Dislike::whereUserId(auth()->id())->whereVideoId($this->video->id)->delete();
            $this->dislikeActive = false;
        }
        else
        {
        $this->video->dislikes()->create([

          'user_id' => auth()->id(),

        ]);    
        $this->disableLike();
        $this->dislikeActive = true;
        }
        $this->emit('load_values');
    }

    public function disableLike()
    {
       Like::whereUserId(auth()->id())->whereVideoId($this->video->id)->delete();
       $this->likeActive = false;
    }

    public function disableDislike()
    {
        Dislike::whereUserId(auth()->id())->whereVideoId($this->video->id)->delete();
        $this->dislikeActive = false;
    }

    public function render()
    {
        $this->likes = $this->video->likes()->count();
        $this->dislikes = $this->video->dislikes()->count();
        return view('livewire.video.voting')->extends('layouts.app');
    }
}
