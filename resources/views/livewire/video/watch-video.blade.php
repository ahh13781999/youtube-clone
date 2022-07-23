<div>
    @push('custom-css')
        <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    @endpush

    <div class="container mx-auto">
        <div class="flex flex-col items-center my-6 w-full">
            <div wire:ignore class="flex flex-col items-center gap-y-6 bg-white rounded border p-6 w-full">
                <video id="my-video" class="video-js vjs-fluid vjs-styles=defaults vjs-big-play-centered" controls
                    preload="auto" poster="{{ asset('videos/' . $video->uid . '/' . $video->thumbnail_image) }}"
                    width="640" height="264" data-setup="{}">
                    <source src="{{ asset('videos/' . $video->uid . '/' . $video->processed_file) }}"
                        type="application/x-mpegURL">
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>

                </video>
                <div class="flex flex-row items-center justify-between w-full">
                    <div class="flex flex-col items-start gap-y-2">
                        <h2 class="text-2xl font-semibold">
                            {{ $video->title }}
                        </h2>
                        <p class="font-semibold text-gray-600">
                            <span>
                                {{ $video->created_at->format('M d Y') }}
                            </span>
                            .
                            <span>
                                {{ $video->views }} Views
                            </span>
                        </p>

                    </div>
                    <div class="">
                        @livewire('video.voting', ['video' => $video])
                    </div>
                </div>
                <div class="w-full">
                    @livewire('channel.channel-info', ['channel' => $video->channel->slug])
                </div>
            </div>
            <div class="w-full">
                @auth
                  @livewire('comment.new-comment', ['video' => $video, 'col' => 0, 'key' => $video->id])
                @endauth
                @livewire('comment.all-comments', ['video' => $video])
            </div>
        </div>
    </div>

    @push('custom-js')
        <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
        <script>
            var player = videojs('my-video')
            player.on('timeupdate', function() {

                if (this.currentTime() > 3) {

                    this.off('timeupdate')

                    Livewire.emit('VideoViewed')
                }

            })
        </script>
    @endpush
</div>
