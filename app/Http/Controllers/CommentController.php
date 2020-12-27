<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return $video->comments()->paginate(10);
    }
}
