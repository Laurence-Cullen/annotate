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
        $images = Auth::user()->uploadedImages;
        $detectionsMap = Images::buildDetectionsMap($images);

        return view('myImages', [
            "images" => $images,
            "detectionsMap" => $detectionsMap,
        ]);
    }
}
