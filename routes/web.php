<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\UploadedImage;

Route::get('/', function () {
    $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

    return view('welcome', [
        "images" => UploadedImage::all(),
        "content" => $content,
    ]);
})->name('home');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/image/{fileName}', 'Images@serve');
Route::post('/image/upload', 'Images@upload');
