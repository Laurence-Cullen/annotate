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

Route::get('/', function () {
    $content = 'This is a longer card with supporting text below as a
                natural lead-in to additional content.
                This content is a little bit longer.';

    $cards = 10;

    return view('welcome', [
        "imagePath" => '/image/chazz.jpg',
        "content" => $content,
        "cards" => $cards,
    ]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/image/{fileName}', 'Images@serve');
