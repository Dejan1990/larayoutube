<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        if (request()->wantsJson()) { //wantsJson()->proverava da li je ovo AJAX request i AJAX odgovor na request
            return $video;
        }

        return view('video', compact('video'));
    }

    public function updateViews(Video $video)
    {
        $video->increment('views');
        return response()->json([]);
    }
}
