<?php

namespace App\Http\Controllers;
use App\UploadedImage;
use App\Detection;
use App\DetectableObject;
use Illuminate\Support\Collection;

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

        return view('master', [
            "images" => UploadedImage::all(),
            "content" => $content,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchString = $request->input('search-string');
        $detected_object = DetectableObject::where('name', '=', $searchString)->first();

        $images = collect();

        // build up a collection of all unique images which contain at least
        // one object matching the search query
        if ($detected_object) {
            foreach ($detected_object->detections as $detection) {
                $image = $detection->image;

                // if images does not contain image already add it to the collection
                if (!$images.contains($image)) {
                    $images = $images->concat($image);
                }
            }
        }

        $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

        return view('search', [
            "images" => $images,
            "content" => $content,
            "searchString" => $searchString,
        ]);
    }
}
