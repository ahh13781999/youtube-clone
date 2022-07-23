<div>
    <div class="flex flex-row items-center gap-x-2 text-gray-500">
        <div class="flex flex-row items-center gap-x-1 cursor-pointer">
            <span wire:click.prevent="like" class="material-icons @if($likeActive) text-blue-300 @else  @endif">thumb_up</span>
            {{ $likes }}
        </div>
        <div class="flex flex-row items-center gap-x-1 cursor-pointer">
            <span wire:click.prevent="dislike" class="material-icons @if($dislikeActive) text-blue-300 @else  @endif">thumb_down</span>
            {{ $dislikes }}
        </div>
    </div>
</div>
