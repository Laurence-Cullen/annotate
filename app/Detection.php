<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    protected $fillable = [
        'object_id', 'image_id', 'confidence',
    ];

    public function image()
    {
        return $this->belongsTo('App\UploadedImage');
    }
}
