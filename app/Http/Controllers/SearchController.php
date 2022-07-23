<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function Search(Request $request)
  {
    if($request->input('query'))
    {
        $q = $request->input('query');
        $videos = Video::query()->where('title','like','%'.$q.'%')->get();

    }
    else
    {
       $videos = collect([]);
    }

    return view('search',compact('videos'));
  }
}
