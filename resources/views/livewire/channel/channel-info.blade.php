<div>
    <div class="flex flex-row items-center justify-between w-full">
        <div class="flex flex-row items-center gap-x-2">
            <img src="{{ asset('images/' . $channel->image) }}" class="rounded-full">
            <div class="flex flex-col items-start">
                <h2 class="font-semibold text-lg">{{ $channel->name }}</h2>
                <p class="text-gray-500">{{ $channel->Subscribers() }} Subscribers</p>
            </div>
        </div>
        <div class="">
            @auth
                @if (auth()->user()->channel->id == $channel->id)
                    <button class="px-4 py-2 uppercase hover:bg-gray-700 bg-red-500 text-white">
                        Your Channel
                    </button>
                @else
                    <button wire:click.prevent="toggle"
                        class="px-4 py-2 uppercase hover:bg-gray-700 {{ $userSubscribed ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                        {{ $userSubscribed ? 'Subscribed' : 'Subscribe' }}
                    </button>
                @endif
            @else
                <button wire:click.prevent="toggle"
                    class="px-4 py-2 uppercase hover:bg-gray-700 {{ $userSubscribed ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                    {{ $userSubscribed ? 'Subscribed' : 'Subscribe' }}
                </button>
            @endauth

        </div>
    </div>
</div>
