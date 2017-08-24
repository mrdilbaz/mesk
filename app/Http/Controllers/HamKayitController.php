<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\HamKayit;
use App\HamKayitTip;
use FFMpeg;
use Exception;

class HamKayitController extends Controller
{
    public function store(Request $request)
    {   
        if ($request->isim == null) {
            $tipler = HamKayitTip::all()->pluck('tip','id');
            return view('sayfalar.hamkayit_yukle', ['tipler'=> $tipler, 'error'=>'İsim Alanı boş bırakılamaz.']);
        }
        $file = $request->dosya;
        $acceptedFileTypes = array('mp3','m4a','aif','wav');
        
        $extension = $file->getClientOriginalExtension();
        if(!in_array($extension,$acceptedFileTypes)){
            $tipler = HamKayitTip::all()->pluck('tip','id');
            return view('sayfalar.hamkayit_yukle', ['tipler'=> $tipler, 'error'=>'Dosya türü uygun değil.']);
        }


        $tmpPath = $file->store('tmp');
        $media = FFMpeg::open($tmpPath);        
        $uzunluk = $media->getDurationInSeconds();
        
        $hamKayit = new HamKayit;

        $hamKayit->isim = $request->isim;
        $hamKayit->tip = $request->tip;
        $hamKayit->uzunluk = $uzunluk;

        $hamKayit->dosya = 'yukleniyor';
        
        $hamKayit->save();

        $filename = $hamKayit->id.".".$file->getClientOriginalExtension();


        $path = $file->storeAs('public/ham_kayitlar/'.$hamKayit->tipisim(), $filename);
        $hamKayit->dosya = $path;
        $hamKayit->update();
        
        $kayitlar = HamKayit::all();
        Storage::delete($tmpPath);
        return view('sayfalar.hamkayit_listele', ['kayitlar'=> $kayitlar, 'success'=>"Kayıt başarıyla eklendi."]);
    }
}
