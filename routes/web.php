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

Route::get('/hamkayit',function(){
    $kayitlar = App\HamKayit::all();
    return view('sayfalar.hamkayit_listele',['kayitlar'=>$kayitlar]);
})->name('hamkayit/listele');

Route::get('hamkayit/duzenle/{id}',function($id){
    $kayit = App\HamKayit::find($id);
    return view('sayfalar.hamkayit_duzenle',['kayit'=>$kayit]);

})->name('hamkayit/duzenle');

Route::post("/hamkayit/yukle", "HamKayitController@store");

Route::post("/hamkayit/sil",'HamKayitController@delete')->name('hamkayit/sil');

Route::get('/',function(){return view('layouts.master');});
