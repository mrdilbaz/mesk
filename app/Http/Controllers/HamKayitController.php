<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HamKayit;
use App\HamKayitTip;

class HamKayitController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->dosya;
        
        if (!$file->isValid()) {
            return "error";
        }
        
        $hamKayit = new HamKayit;

        $hamKayit->isim = $request->isim;
        $hamKayit->tip = $request->tip;
        $hamKayit->uzunluk = 0;
        $hamKayit->dosya = 'yukleniyor';
        $hamKayit->save();

        $path = $file->storeAs(
            'ham_kayitlar/'.$hamKayit->tipisim(),$hamKayit->isim.'-'.$hamKayit->id.'.'.$file->extension(), 's3');

        $hamKayit->dosya = $path;
        $hamKayit->update();

        $extension = $file->extension();
        echo $extension;
    }
}
