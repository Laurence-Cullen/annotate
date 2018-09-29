<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UploadedImage
 *
 * @mixin \Eloquent
 * @property string raw_path
 * @property string predictions_path
 * @property int id
 * @property int|null user_id
 * @property string hash
 */
class UploadedImage extends Model
{
    protected $fillable = [
        'hash',
        'raw_path',
        'predictions_path',
        'user_id',
    ];

    /**
     * Process the image saved at raw_path and save an image highlighting the detected objects
     * of the initial image in the same folder with the suffix _prediction before the image extension.
     * Sets the magic attribute value 'predictions_path' and saves the generated Detection objects
     * to the database.
     *
     * Uses the darknet deep learning framework, info: https://pjreddie.com/darknet/
     *
     * Involves a lot of bash hacking, sorry!
     */
    public function detectObjects()
    {
        // assuming darknet install in home directory and that YOLO3 model has been loaded
        // TODO fix absolute path!!!
        $darknetPath = "/Users/laurence/darknet";

        $imageFilename = pathinfo($this->raw_path)['filename'];

        // delete any previous prediction outputs to
        echo exec("rm $darknetPath/predictions.*");

        // change working directory to darknet location, needed to run due to darknet idiosyncrasies
        chdir($darknetPath);

        $absoluteImagePath = $this->absoluteRawPath();

//        dd($absoluteImagePath);

        // build run command
        $runCommand = "~/darknet/darknet detect $darknetPath/cfg/yolov3.cfg $darknetPath/yolov3.weights $absoluteImagePath";

        $output = [];
        // executing run command
        exec($runCommand, $output);

        $darknetPredictionsPath = exec("ls $darknetPath/predictions.*");
        $predictionsExtension = pathinfo($darknetPredictionsPath)['extension'];

        // changing working directory back to directory this file is stored in
        // TODO find a more maintainable way to manage working directory
        chdir(dirname(__FILE__));
        $this->predictions_path = storage_path("images/$imageFilename" . "_prediction.$predictionsExtension");

        // throwing object up to database and then pulling down auto incremented id value assigned to it
        $this->save();

        $detectionConfidences = $this->parseDetectionOutput($output);
        $this->saveDetections($detectionConfidences);

        // move prediction image from its initial location in
        // $darknetPath to the correct location with the laravel project
        echo exec("mv $darknetPredictionsPath $this->predictions_path");
    }

    /** Saves the detections to the database.
     * @param $detectionConfidences array
     */
    private function saveDetections($detectionConfidences) {
//        dd($detectionConfidences);
        foreach($detectionConfidences as $objectName => $confidence){

            $detectableObject = DetectableObject::where('name', '=', $objectName)->first();

            // adds new detectable object to db if not already present
            if (!$detectableObject) {
                DetectableObject::create(['name' => $objectName]);
                $detectableObject = DetectableObject::where('name', '=', $objectName)->first();
            }

            Detection::create([
                'detectable_object_id' => $detectableObject->id,
                'image_id' => $this->id,
                'confidence' => $confidence,
            ]);
        }
//        dd('all detections saved to db');
    }

    /**
     * Parses output from darknet object detection command into an associative
     * array mapping detected object names to the confidence with which they were detected.
     *
     * @param $detectionOutput array of strings corresponding to each line of output
     * @return array
     */
    private function parseDetectionOutput($detectionOutput)
    {
        // associative array mapping from strings of object names
        // to the confidence with which they were detected
        $detectionConfidences = [];
        for($i=1; $i < count($detectionOutput); $i++) {
            $stringElements = explode(': ', $detectionOutput[$i]);
            $objectName = $stringElements[0];
            $confidenceString = str_replace('%', '', $stringElements[1]);

            $detectionConfidences[$objectName] = ((float)$confidenceString) / 100;
        }
        return $detectionConfidences;
    }

    public function absoluteRawPath() {
        return storage_path("images/$this->raw_path");
    }

    public function absolutePredictionsPath() {
        return storage_path("images/$this->predictions_path");
    }
}

