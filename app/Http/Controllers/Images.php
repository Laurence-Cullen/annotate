<?php

namespace App\Http\Controllers;

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

    public static function upload()
    {
        // read image from temporary file
        $img = Image::make($_FILES['image']['tmp_name']);
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $hash = rand(0, 1e10);
        $filename = "$hash.$extension";

        $imageSavePath = storage_path("images/$filename");

        // save image
        $img->save($imageSavePath);

        // run object detection routine on uploaded image
        $predictionsPath = Images::detect_objects($imageSavePath);

        UploadedImage::create([
            'raw_path' => $filename,
            'predictions_path' => $predictionsPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route($_POST['route']);
    }

    /**
     * Processes the image at $image_path and save an image highlighting the detected objects
     * of the initial image in the same folder with the suffix _prediction.
     * Uses the darknet deep learning framework, info: https://pjreddie.com/darknet/
     *
     * Involves a lot of bash hacking, sorry!
     *
     * @param $image_path string, path to image to process
     * @return string, path that object detection prediction image has been saved to
     */
    public static function detect_objects($image_path)
    {
        // assuming darknet install in home directory and that YOLO3 model has been loaded
        // TODO fix absolute path!!!
        $darknetPath = "/Users/laurence/darknet";

        $image_filename = pathinfo($image_path)['filename'];

        // delete any previous prediction outputs to
        echo exec("rm $darknetPath/predictions.*");

        $absoluteImagePath = realpath($image_path);

        // change working directory to darknet location, needed to run due to darknet idiosyncrasies
        chdir($darknetPath);

        // build run command
        $runCommand = "~/darknet/darknet detect $darknetPath/cfg/yolov3.cfg $darknetPath/yolov3.weights $absoluteImagePath";

        // executing run command
        echo exec($runCommand);

        $predictionsPath = exec("ls $darknetPath/predictions.*");
        $predictionsExtension = pathinfo($predictionsPath)['extension'];

        // changing working directory back to directory this file is stored in
        // TODO find a more maintainable way to manage working directory
        chdir(dirname(__FILE__));
        $predictionsSavePath = storage_path("images/$image_filename" . "_prediction.$predictionsExtension");

        // move prediction image from its initial location in
        // $darknetPath to the correct location with the laravel project
        echo exec("mv $predictionsPath $predictionsSavePath");

        return realpath($predictionsSavePath);
    }
}
