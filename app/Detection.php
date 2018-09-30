<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    protected $fillable = [
        'detectable_object_id', 'uploaded_image_id', 'confidence',
    ];

    public function image()
    {
        return $this->belongsTo('App\UploadedImage', 'uploaded_image_id');
    }

    public function detectableObject()
    {
        return $this->belongsTo('App\DetectableObject');
    }
}
