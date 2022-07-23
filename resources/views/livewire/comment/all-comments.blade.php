<div>
    <div class="flex flex-col my-6 bg-white gap-y-2 p-4 w-full">
        <h2 class="text-lg font-bold my-4">
            {{ $video->AllCommentsCount() }} Comments
        </h2>
        @include('includes.recursive',['comments' => $video->comments()->latestFirst()->get()])
    </div>
</div>
