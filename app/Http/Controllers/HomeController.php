<?php

namespace App\Http\Controllers;
use App\UploadedImage;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

        return view('welcome', [
            "images" => UploadedImage::all(),
            "content" => $content,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

        return view('welcome', [
            "images" => UploadedImage::all(),
            "content" => $content,
        ]);
    }

    public function myImages() {
        $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

        return view('welcome', [
            "images" => \Auth::user()->uploadedImages,
            "content" => $content,
        ]);
    }
}
