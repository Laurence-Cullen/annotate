<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use App\UploadedImage;

class Images extends Controller
{
    /**
     * @param $fileName string
     * @return mixed
     */
    public static function serve($fileName)
    {
        $storagePath = storage_path("images/$fileName");
        return Image::make($storagePath)->response('jpg');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function upload(Request $request)
    {
        // read image from temporary file
        $img = Image::make($request->file('image')->getPathname()); //  ['tmp_name']);
        $extension = $request->file('image')->getClientOriginalExtension();

        $hash = rand(0, 1e10);
        $rawPath = "$hash.$extension";

        $imageSavePath = storage_path("images/$rawPath");

        // save image to disk
        $img->save($imageSavePath);

        $uploadedImage = new UploadedImage;
        $uploadedImage->raw_path = $rawPath;
        $uploadedImage->hash = $hash;
        $uploadedImage->user_id = Auth::id();

        // run object detection routine on uploaded image
        $uploadedImage->detectObjects();

        echo 'Made it to the end of upload script';
        // redirecting to route passed in through POST request
        return redirect()->route($request->post('route'));
    }

    /**
     * Return an associative array mapping UploadedImage ids to an array specifying how
     * many objects of different types were identified in the respective image.
     *
     * @param $uploadedImages Collection
     * @return array[]
     */
    public static function buildDetectionsMap($uploadedImages)
    {
        $detectedObjectsMap = [];

        foreach ($uploadedImages as $uploadedImage) {
            $detectedObjectsMap[$uploadedImage->id] = $uploadedImage->detectedObjects();
        }
        return $detectedObjectsMap;
    }
}
