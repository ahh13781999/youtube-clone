@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col items-start bg-red-200 h-44">
        <div class="container mx-auto my-auto px-4">
            <h2 class="text-4xl my-2">{{ $channel->name }}</h2>
            <h4 class="text-xl">{{ $channel->description }}</h4>
        </div>
    </div>
    <div class="w-full bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-row justify-between items-center w-full py-8">
                <div class="flex flex-row items-center gap-x-2">
                    <img class="h-20 w-20 rounded-full border-4 border-white ring-[2px] ring-gray-300" src="{{ asset('images/'.$channel->image) }}" alt="">
                    <div class="flex flex-col items-start gap-y-2">
                        <h2 class="text-xl font-bold">{{ $channel->name }}</h2>
                        <p class="font-semibold text-gray-500">{{ $channel->Subscribers() }} Subscribers</p>
                    </div>
                </div>

                <a href="{{ route('edit.channel',[$channel]) }}" class="px-4 py-3 text-lg rounded-lg bg-blue-500 text-white font-semibold hover:opacity-75">
                    Edit Channel
                </a>

            </div>
        </div>
    </div>
    <div class="container mx-auto my-12">
        <div class="w-full bg-white py-8 px-2">
            <div class="grid grid-cols-12 gap-x-4 gap-y-6">
                @foreach ($channel->videos as $video)
                    <div class="xl:col-span-3 lg:col-span-4 md:col-span-6 col-span-12">
                        <div class="flex flex-col justify-between gap-y-4 w-fit mx-auto">
                            <div class="">
                             <a href="{{ route('video.watch',$video) }}"><img src="{{ asset('videos/' . $video->uid . '/' . $video->thumbnail_image) }}"
                                    class="h-44 w-80" alt=""></a> 
                            </div>
                            <div class="flex flex-row gap-x-2">
                                <div class="">
                                    <img class="h-12 w-12 rounded-full" src="{{ asset('images/' . $video->channel->image) }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col gap-y-1">
                                    <h2 class="font-semibold text-xl">
                                        <a href="{{ route('video.watch',$video) }}">{{ $video->title }}</a>
                                    </h2>

                                    <h4 class="text-lg font-semibold">
                                        <a href="{{ route('index.channel',[$video->channel]) }}">{{ $video->channel->name }}</a>
                                    </h4>
                                    <div class="inline-flex font-semibold text-gray-800">
                                    <p class="after:content-['•'] after:mx-2">{{ $video->views }} views</p>
                                    <p>{{ $video->created_at->diffForHumans() }}</p>
                                </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
