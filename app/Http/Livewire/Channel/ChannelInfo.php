<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use App\Models\Subscription;
use Livewire\Component;

class ChannelInfo extends Component
{
    public $channel;
    public $userSubscribed = false;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;

        if(auth()->check()){

            if(auth()->user()->isSubscribed($this->channel)){
            
                $this->userSubscribed = true;
            }
        }
    }
    
    public function toggle()
    {
        if(!auth()->check()){
            return redirect('/login');
        }
        if(auth()->user()->isSubscribed($this->channel))
        {
          Subscription::where('user_id',auth()->id())->where('channel_id',$this->channel->id)->delete();
          $this->userSubscribed = false;
        }
        else
        {
          $this->channel->Subscriptions()->create([

            'user_id' => auth()->id(),

          ]);
          $this->userSubscribed = true;
        }
    }

    public function render()
    {
        return view('livewire.channel.channel-info')->extends('layouts.app');
    }
}
