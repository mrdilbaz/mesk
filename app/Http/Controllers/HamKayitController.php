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
        
        if ($file == null || !$file->isValid() || $request->isim == null) {
            $kayitlar = HamKayit::all();
            return view('sayfalar.hamkayit_listele',['kayitlar'=> $kayitlar, 'yukleme'=>false]);  
        }
        
        $hamKayit = new HamKayit;

        $hamKayit->isim = $request->isim;
        $hamKayit->tip = $request->tip;
        $hamKayit->uzunluk = rand(30,60*60*2);

        $hamKayit->dosya = 'yukleniyor';
        
        $hamKayit->save();

        $filename = $hamKayit->id.".".$file->getClientOriginalExtension();


        $path = $file->storeAs('ham_kayitlar/'.$hamKayit->tipisim(),$filename);
        $hamKayit->dosya = $path;
        $hamKayit->update();
        
        $kayitlar = HamKayit::all();
        return view('sayfalar.hamkayit_listele',['kayitlar'=> $kayitlar, 'yukleme'=>true]);  
    }
}
