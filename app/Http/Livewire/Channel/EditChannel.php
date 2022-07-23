<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class EditChannel extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $channel;
    public $image;

    protected function rules(){
     return
        [
            'channel.name' => ['required','max:255','unique:channels,name,'.$this->channel->id],
            'channel.slug' => ['required','max:255','unique:channels,slug,'.$this->channel->id],
            'channel.description' => ['nullable','max:1000'],
            'image' => ['nullable','image','max:3096'],
        ];
    }

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function update()
    {
       $this->authorize('update',$this->channel);

       $this->validate();

       $this->channel->update([

           'name' => $this->channel->name,
           'slug' => $this->channel->slug,
           'description' => $this->channel->description,
       
        ]);

        // UPDATE CHANNEL IMAGE
        if($this->image)
        {
            $imagePath = $this->image->storeAs('images',$this->channel->uid.'.png');
            $imageName = explode('/',$imagePath)[1];
            Image::make(storage_path().'/app/'.$imagePath)->resize(80,80)->encode('png')->save();

            $this->channel->update([
                'image' => $imageName,
            ]);
        }

        session()->flash('message','Channel Information Updated Successfully!');
        
        return redirect()->route('edit.channel',[$this->channel->slug]);
    }

    public function render()
    {
        return view('livewire.channel.edit-channel');
    }
}
