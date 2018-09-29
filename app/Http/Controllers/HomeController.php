<?php

namespace App\Http\Controllers;

use App\DetectableObject;
use App\UploadedImage;
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

        $images = UploadedImage::all();
        $detectionsMap = Images::buildDetectionsMap($images);

        return view('index', [
            "images" => $images,
            "detectionsMap" => $detectionsMap,
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

        if(!$searchString) {
            return redirect()->route('home');
        }

        $detectedObject = DetectableObject::where('name', '=', $searchString)->first();

        $images = collect();

        // build up a collection of all unique images which contain at least
        // one object matching the search query
        if ($detectedObject) {
            foreach ($detectedObject->detections as $detection) {
                $image = $detection->image;
                // if images does not contain image already add it to the collection
                if (!$images->contains($image)) {
                    $images->push($image);
                }
            }
        } else {
            // find all detectable objects that have been found in at least one image
            $detectedObjects = [];
        }

        $detectionsMap = Images::buildDetectionsMap($images);

        return view('search', [
            "images" => $images,
            "detectionsMap" => $detectionsMap,
            "searchString" => $searchString,
        ]);
    }
}
