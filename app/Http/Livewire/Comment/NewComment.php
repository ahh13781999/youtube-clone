<?php

namespace App\Http\Livewire\Comment;

use App\Models\Video;
use Livewire\Component;

class NewComment extends Component
{
    public $video;
    public $body;
    public $col;

    public function mount(Video $video, $col)
    {
          $this->video = $video;
          $col == 0 ? $this->col = null : $this->col  = $col;
    }

    public function resetForm()
    {
        $this->body = '';
    }

    public function addComment()
    {
        auth()->user()->comments()->create([

            'video_id' => $this->video->id,
            'body' => $this->body,
            'reply_id' => $this->col,

        ]);

        $this->body = "";

        $this->emitTo('comment.all-comments','refreshComments');

    }

    public function render()
    {
        return view('livewire.comment.new-comment')->layout('layouts.app');
    }
}
