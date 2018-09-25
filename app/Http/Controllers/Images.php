<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class Images extends Controller
{
    public static function serve($fileName) {
        $storagePath = storage_path("images/$fileName");
        return Image::make($storagePath)->response('jpg');
    }
}
