<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Video\AllVideo;
use App\Http\Livewire\Video\CreateVideo;
use App\Http\Livewire\Video\EditVideo;
use App\Http\Livewire\Video\WatchVideo;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   if(Auth::check())
   {
    $channels = Auth::user()->subscribedChannels()->with('videos')->get()->pluck('videos');
   }
   else{
    $channels = Channel::get()->pluck('videos');
   }
   return view('welcome',compact('channels'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function(){
    Route::get('/channel/{channel}/edit',[ChannelController::class,'edit'])->name('edit.channel');
    Route::get('/videos/{channel}/create',CreateVideo::class)->name('video.create');
    Route::get('/videos/{channel}/{video}/edit',EditVideo::class)->name('video.edit');
    Route::get('/videos/{channel}',AllVideo::class)->name('video.all');
});

Route::get('/watch/{video}',WatchVideo::class)->name('video.watch');
Route::get('/channel/{channel}',[ChannelController::class,'index'])->name('index.channel');
Route::get('/search',[SearchController::class,'Search'])->name('search');
