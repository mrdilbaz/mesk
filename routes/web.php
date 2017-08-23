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

Route::get('/hamkayit/yukle', function () {
    $tipler = App\HamKayitTip::all()->pluck('tip','id');
    return view('sayfalar.hamkayit_yukle',['tipler'=>$tipler]);
})->name('hamkayit/yukle');

Route::post("/hamkayit/yukle", "HamKayitController@store");
