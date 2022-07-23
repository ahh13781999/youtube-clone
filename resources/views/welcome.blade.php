@extends('layouts.app')

@section('content')
    <div class="my-8 container mx-auto ">
        <form method="GET" action="{{ route('search') }}" class="bg-white my-4 w-full p-4">
            @csrf
            <div x-data class="flex flex-row items-center relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-0 ml-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                <input x-on:focus="$el.nextElementSibling.classList.add('border-gray-400')" x-on:click.outside="$el.nextElementSibling.classList.remove('border-gray-400')" class="border-gray-200 w-full pl-10 focus:ring-0 focus:border-gray-400 focus:border-2 appearance-none" type="search" name="query" placeholder="Search...">
                <button type="submit" class="absolute right-0 px-4 border-2 h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                </button>
            </div>
        </form>
        <div class="grid grid-cols-12 gap-x-4 gap-y-8 p-4 bg-white">
            @if (!$channels->count())
              <p class="mx-auto font-bold text-2xl col-span-12">You are not subscribed to any channel yet!</p>                
            @endif
            @foreach ($channels as $channel)
                @foreach ($channel as $video)
                    <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">

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
            @endforeach
        </div>
    </div>
@endsection
