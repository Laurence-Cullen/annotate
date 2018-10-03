<?php

namespace App\Http\Controllers;

use App\DetectableObject;
use App\UploadedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;

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

        if (!$searchString) {
            return redirect()->route('home');
        }

        $detectedObject = DetectableObject::where('name', '=', $searchString)->first();

        $images = collect();
        $similarDetectableObjects = collect();

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

            // establish database connection to use for real char escaping
            // TODO
            $mysqli = new mysqli(
                env("DB_HOST" , ''),
                env("DB_USERNAME" , ''),
                env("DB_PASSWORD" , ''),
                env("DB_DATABASE" , ''),
                env("DB_PORT" , '')
            );

            $sanitizedSearchString = $mysqli->real_escape_string($searchString);

            $similarDetectableObjects = DB::select(
                DB::raw(
                    "SELECT name, MATCH (name) AGAINST ('$sanitizedSearchString' IN NATURAL LANGUAGE MODE) AS score
                     FROM laravel_annotate.detectable_objects
                     WHERE MATCH (name) AGAINST ('$sanitizedSearchString' IN NATURAL LANGUAGE MODE)"
                )
            );
        }

        $detectionsMap = Images::buildDetectionsMap($images);

        return view('search', [
            "images" => $images,
            "detectionsMap" => $detectionsMap,
            "searchString" => $searchString,
            "similarDetectableObjects" => $similarDetectableObjects
        ]);
    }
}
