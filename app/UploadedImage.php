<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadedImage extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
