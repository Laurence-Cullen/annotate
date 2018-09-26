<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyImages extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function images()
    {
        $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

        return view('myImages', [
            "images" => Auth::user()->uploadedImages,
            "content" => $content,
        ]);
    }
}
