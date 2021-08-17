<?php

use Illuminate\Support\Facades\Route;


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
    return view('welcome');
});
Route::get('profileimages/{filename}', function ($filename)
{
    return Image::make(storage_path(). '/profileimages/' .$filename)->response();
});
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Yeni bir lokasyon hesabınıza eklendi',
        'body' => 'Lokasyon yetkili panelinize ladmin.nereyeatayim.com adresinden ulaşabilirsiniz.'
    ];
   
    \Mail::to('ggokbudak8@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});
//Route::get('konumduzenle', 'StartController@konumduzenle');
//Route::get('sonislemduzenle', 'StartController@sonislemduzenle');
Route::get('appData', 'StartController@appData');

