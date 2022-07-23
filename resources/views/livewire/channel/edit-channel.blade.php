<div class="w-full xl:w-1/2 p-4">

    @if (session()->has('message'))
        <div class="bg-green-300 border-2 py-2 my-4 rounded-md border-green-500">
            <p class="px-4 font-semibold text-lg text-green-900">{{ session()->get('message') }}</p>
        </div>
    @endif

    <form wire:submit.prevent="update" class="flex flex-col" wire:self.ignore enctype="multipart/form-data">
        
        @if($channel->image)
        <div class="my-2">
            <img src="{{ asset('images/'.$channel->image) }}" class="rounded-full">
        </div>
        @endif

        <!-- Channel Name -->
        <div>
            <x-label for="name" :value="__('Name')" />
            <x-input wire:model="channel.name" id="name" class="block mt-1 w-full" type="text" />
        </div>
        @error('channel.name')
            <div class="my-2 px-4">
                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
            </div>
        @enderror

        <!-- Channel Slug -->
        <div class="mt-4">
            <x-label for="slug" :value="__('Slug')" />
            <x-input wire:model="channel.slug" id="slug" class="block mt-1 w-full" type="text" />
        </div>
        @error('channel.slug')
            <div class="my-2 px-4">
                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
            </div>
        @enderror

        <!-- Channel Image -->
        <div class="mt-4">
            <x-label for="image" :value="__('Image')" />
            <x-input wire:model="image" wire:loading.attr="disabled" id="image" class="block mt-1 w-full" type="file" />
        </div>
        <div wire:loading.delay wire:target="image" class="my-2 font-semibold text-green-500">
            Loading...
        </div>
        @if ($image)
            <div class="my-4">
                <img src="{{ $image->temporaryUrl() }}" class="h-20 w-20 rounded-lg">
            </div>
        @endif
        @error('image')
            <div class="my-2 px-4">
                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
            </div>
        @enderror

        <!-- Channel Description -->
        <div class="mt-4">
            <x-label for="description" :value="__('Description')" />
            <textarea wire:model="channel.description"
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                cols="30" rows="10"></textarea>
        </div>
        @error('channel.description')
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
