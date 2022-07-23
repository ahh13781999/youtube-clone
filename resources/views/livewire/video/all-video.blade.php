<div>
    <div class="container mx-auto">
        <div class="flex flex-col items-center gap-y-2 my-6">
            @if ($videos->count() > 0)
                @foreach ($videos as $video)
                    <div class="flex flex-row items-center justify-around bg-white border-2 w-full px-2 py-4 rounded">
                        <a href="{{ route('video.watch',$video) }}">
                            <img class="w-20 h-20 rounded-md" src="{{ asset($video->thumbnail) }}" alt="">
                        </a>
                        <h2 class="text-lg tracking-wide">
                            {{ $video->title }}
                        </h2>

                        @if ($video->visibility == 'private')
                            <p class="bg-green-300 py-1 px-2 rounded">Private</p>
                        @else
                            <p class="bg-orange-300 py-1 px-2 rounded">Public</p>
                        @endif

                        <p class="text-lg font-semibold text-gray-800">
                            {{ $video->created_at->diffForHumans() }}
                        </p>
                        @if (auth()->user()->owns($video))
                            <div class="flex flex-row items-center gap-x-2">
                                <a href="{{ route('video.edit', ['channel' => $video->channel, 'video' => $video]) }}"
                                    class="px-4 py-2 font-bold rounded bg-blue-500 hover:opacity-80 text-white">
                                    Edit
                                </a>
                                <a wire:click.prevent="delete('{{ $video->uid }}')"
                                    class="px-4 py-2 font-bold rounded bg-red-500 hover:opacity-80 text-white">
                                    Delete
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
                {{ $videos->links() }}
            @else
            <p class="text-xl font-semibold">Nothing Uploaded Yet</p>
            @endif
        </div>
    </div>
</div>
