<div class="ml-8">
    @foreach ($comments as $comment)
        <div class="flex flex-col justify-between gap-y-2 mb-4" x-data="{ open: false }">
            <div class="flex flex-row items-center gap-x-2">
                <img class="rounded-full h-12 w-12" src="{{ asset('images/' . $comment->user->channel->image) }}" alt="">
                <div class="flex flex-col gap-y-1 items-start">
                    <p class="font-bold">
                        {{ $comment->user->name }}
                    </p>
                    <p class="text-gray-500">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
            <p>
                {{ $comment->body }}
            </p>
        </div>
    @endforeach
</div>
