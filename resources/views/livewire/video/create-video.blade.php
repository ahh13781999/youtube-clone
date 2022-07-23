<div class="container mx-auto w-full bg-white my-4">
    <div class="flex flex-row justify-center items-center w-full">
        <div class="w-full xl:w-1/2 p-4">

            @if (session()->has('message'))
                <div class="bg-green-300 border-2 py-2 my-4 rounded-md border-green-500">
                    <p class="px-4 font-semibold text-lg text-green-900">{{ session()->get('message') }}</p>
                </div>
            @endif

            <div class="flex flex-col" wire:self.ignore x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false , $wire.fileCompleted()"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <!-- Video -->
                <div x-show="isUploading" class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${progress}%`">
                    </div>
                </div>
                <div class="mt-4">
                    <x-label class="mb-2 text-lg font-bold" for="videoFile" :value="__('Video')" />
                    <x-input wire:model="videoFile" wire:change="upload" wire:loading.attr="disabled" id="videoFile"
                        class="block mt-1 w-full" type="file" />
                </div>
                @error('videoFile')
                    <div class="my-2 px-4">
                        <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                    </div>
                @enderror

            </div>
        </div>
    </div>
</div>
