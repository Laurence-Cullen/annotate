<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\UploadedImage;

class Images extends Controller
{
    public static function serve($fileName)
    {
        $storagePath = storage_path("images/$fileName");
        return Image::make($storagePath)->response('jpg');
    }

    public static function upload()
    {
        // read image from temporary file
        $img = Image::make($_FILES['image']['tmp_name']);
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $hash = rand(0, 1e10);
        $filename = "$hash.$extension";

        // save image
        $img->save(storage_path("images/$filename"));

        UploadedImage::create([
            'raw_path' => $filename,
            'predictions_path' => $filename,
            'user_id' => Auth::id()
        ]);

        return redirect()->route($_POST['route']);
    }
}
