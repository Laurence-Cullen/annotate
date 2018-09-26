<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class UploadedImage extends Model
{
    protected $fillable = [
        'raw_path', 'predictions_path', 'user_id',
    ];
}
