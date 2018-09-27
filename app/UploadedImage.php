<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UploadedImage
 *
 * @mixin \Eloquent
 */
class UploadedImage extends Model
{
    protected $fillable = [
        'raw_path', 'predictions_path', 'user_id',
    ];
}
