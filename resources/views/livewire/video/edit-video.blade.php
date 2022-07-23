<div @if($this->video->processing_percentage < 100) wire:poll @endif class="container mx-auto w-full bg-white my-4">
    <div class="flex flex-row justify-center items-center w-full">
        <div class="w-full xl:w-1/2 p-4">

            @if (session()->has('message'))
            <div class="bg-green-300 border-2 py-2 my-4 rounded-md border-green-500">
                <p class="px-4 font-semibold text-lg text-green-900">{{ session()->get('message') }}</p>
            </div>
        @endif
    
        <form wire:submit.prevent="update" class="flex flex-col" wire:self.ignore>
    
            <!-- Video Thumbnail Image -->
            <div class="my-4 flex flex-col gap-y-2">
                <img class="h-20 w-20 rounded-xl border-4 border-gray-300" src="{{ asset($this->video->thumbnail) }}" alt="">
                <p class="font-semibold text-lg text-gray-600">
                    Processing {{ $this->video->processing_percentage }}%
                </p>
            </div>
            <!-- Video Thumbnail Image -->

            <!-- Video Title -->
            <div>
                <x-label for="title" :value="__('Title')" />
                <x-input wire:model="video.title" id="title" class="block mt-1 w-full" type="text" />
            </div>
            @error('video.title')
                <div class="my-2 px-4">
                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                </div>
            @enderror
    
            <!-- Video Visibility -->
            <div class="mt-4">
                <x-label for="visibility" :value="__('Visibility')"/>
                <select wire:model="video.visibility" id="visibility" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                    <option value="unlisted">Unlisted</option>
                </select>
            </div>
            @error('video.visibility')
                <div class="my-2 px-4">
                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                </div>
            @enderror
    
            <!-- Video Description -->
            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />
                <textarea wire:model="video.description"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    cols="30" rows="10"></textarea>
            </div>
            @error('video.description')
                <div class="my-2 px-4">
                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                </div>
            @enderror
    
            <!-- Button -->
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="ml-4 bg-blue-500 hover:bg-blue-300 text-white rounded py-2 px-4 focus:ring focus:ring-blue-500">
                    Update
                </button>
            </div>
    
        </form>
    </div>
</div>
