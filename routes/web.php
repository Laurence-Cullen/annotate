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


Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/my_images', 'HomeController@myImages')->name('myImages');

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logoutRedirect')->name('logoutRedirect');

Route::get('/image/{fileName}', 'Images@serve');
Route::post('/image/upload', 'Images@upload')->name('upload');
