@foreach ($video->Comments as $comment)
    <div class="flex flex-col justify-between gap-y-2 my-2" x-data="{ open: false }">
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
        <div class="flex flex-col items-start gap-x-2">
            <p x-data class="inline-flex gap-x-1 mt-2">
                {{ $comment->body }}
            @auth
                <a x-on:click.prevent="$refs.replay.classList.toggle('hidden')" href="" class="font-bold text-gray-800">Reply</a>
                <div x-ref="replay" class="w-full hidden">
                    @livewire('comment.new-comment', ['video' => $video, 'col' => $comment->id, 'key' => $video->id.uniqid()])
                </div>
            @endauth
            </p>

            @if ($comment->replies->count())
                <a href="" @click.prevent="open = !open"
                    class="my-2 inline-flex items-center text-blue-600 font-semibold hover:opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                      </svg>
                    view
                    {{ $comment->replies->count() }} replies</a>
                <div class="my-2" x-show="open" x-transition>
                    @include('includes.recursive2', ['comments' => $comment->replies])
                </div>
            @endif
        </div>
    </div>
@endforeach
