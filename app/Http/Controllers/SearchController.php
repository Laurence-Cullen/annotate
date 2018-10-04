<?php

namespace App\Http\Controllers;

use App\DetectableObject;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // used by auto complete to get partially matching names of detectableObjects
    public function searchObjects(Request $request)
    {
        return DetectableObject::where('name', 'LIKE', '%' . $request->q . '%')->get();
    }
}
