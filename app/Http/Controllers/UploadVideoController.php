<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;

class UploadVideoController extends Controller
{
    public function index(Channel $channel)
    {
        return view('channels.upload', compact('channel'));
    }
}
