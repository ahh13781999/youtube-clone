<div class="w-full">
    <div class="flex flex-col justify-between bg-white h-full w-full gap-y-4 p-6">
       <div class="">
        <img src="{{ asset('images/' . auth()->user()->channel->image) }}" class="w-14 h-14 rounded-full">
       </div>
        <input wire:model="body" type="text" class="border-0 border-b-2 border-gray-400 focus:border-transparent focus:border-b-2 focus:border-gray-400 focus:ring-0" placeholder="Add a public comment">
        <div class="flex flex-row  justify-end items-center gap-x-1">
            @if ($body)
                <a wire:click.prevent="resetForm" href="" class="rounded-lg px-4 py-2 bg-gray-200 font-bold hover:opacity-75 text-white">Cancel</a>
                <a wire:click.prevent="addComment" href="" class="rounded-lg px-4 py-2 bg-red-500 font-bold hover:opacity-75 text-white">Comment</a>
            @endif

        </div>
    </div>
</div>
