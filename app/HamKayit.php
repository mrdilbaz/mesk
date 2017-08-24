<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HamKayit extends Model
{
    //
    protected $guarded = [];
    
    public function tipisim(){
        return HamKayitTip::find($this->tip)->tip;
    }

    public function saniye(){
        $saniye = (int)$this->uzunluk;
        $string = "";
        $saat = intdiv($saniye,60*60);
        $dakika = intdiv($saniye%(60*60),60);
        $san = $saniye % 60;

        if($saat>0){
            $string = $saat.":".sprintf("%'.02d",$dakika).":".sprintf("%'.02d",$san);
        } else {
            $string = $dakika.":".sprintf("%'.02d\n",$san);
        }
        return $string;
    }

    public function dosyaAdi(){
           return Storage::url('public/ham_kayitlar/'.$this->tipisim().'/'.$this->dosya);
    }
}
