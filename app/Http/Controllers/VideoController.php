<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index (){
        $videos = Video::with('comments')->simplePaginate(10);
        return view('video', compact('videos'));
    }
    public function show($id){
        $videos = Video::with('comments')->findOrFail($id);
        return view('singleVideo', compact('videos'));
    }
}
