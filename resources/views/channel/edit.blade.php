@extends('layouts.app')

@section('content')
<div class="container mx-auto w-full bg-white my-4">
    <div class="flex flex-row justify-center items-center w-full">
          @livewire('channel.edit-channel', ['channel' => $channel])
    </div>
</div>
@endsection