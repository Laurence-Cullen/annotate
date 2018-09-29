<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Intervention\Image\Facades\Image;
use App\UploadedImage;

class Images extends Controller
{
    public static function serve($fileName)
    {
        $storagePath = storage_path("images/$fileName");
        return Image::make($storagePath)->response('jpg');
    }

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
}
