<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function images(Request $request)
    {
        $images = Auth::user()->uploadedImages;
        $detectionsMap = ImagesController::buildDetectionsMap($images);
        $images = $images->sortByDesc('created_at');
        $images = PaginationController::collectionToPaginator($images, $request);

//        dd($images);

        return view('myImages', [
            "images" => $images,
            "detectionsMap" => $detectionsMap,
        ]);
    }
}
