<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetectableObject extends Model
{
    protected $fillable = ['name'];

    public function detections()
    {
        return $this->hasMany('App\Detection');
    }
}
