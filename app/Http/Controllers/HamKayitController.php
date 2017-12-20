<?php

namespace App\Http\Controllers;

use App\HamKayit;
use App\Ilahi;
use App\HamKayitTip;
use Exception;
use FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HamKayitController extends Controller
{
    public function store(Request $request)
    {
        if ($request->isim == null) {
            $tipler = HamKayitTip::all()->pluck('tip', 'id');
            return view('sayfalar.hamkayit_yukle', ['tipler' => $tipler, 'error' => 'İsim Alanı boş bırakılamaz.']);
        }
        $file = $request->dosya;
        $acceptedFileTypes = array('mp3', 'm4a', 'aif', 'wav');

        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $acceptedFileTypes)) {
            $tipler = HamKayitTip::all()->pluck('tip', 'id');
            return view('sayfalar.hamkayit_yukle', ['tipler' => $tipler, 'error' => 'Dosya türü uygun değil.']);
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

        $filename = $hamKayit->id . "." . $file->getClientOriginalExtension();

        $path = $file->storeAs('public/ham_kayitlar/' . $hamKayit->tipisim(true), $filename);
        $hamKayit->dosya = $path;
        $hamKayit->update();

        $kayitlar = HamKayit::all();
        Storage::delete($tmpPath);
        return view('sayfalar.hamkayit_listele', ['kayitlar' => $kayitlar, 'success' => "Kayıt başarıyla eklendi."]);
    }

    public function delete(Request $request)
    {

        if ($request->kayit_id == null) {
            return response(['error' => true]);
        }

        $kayit = HamKayit::find($request->kayit_id);
        Storage::delete($kayit->dosya);
        $kayit->delete();
        return response(['error' => false]);
    }

    public function parcala(Request $request)
    {
        $kayit = HamKayit::find($request->hamkayit_id);
        $media = FFMpeg::open($kayit->dosya);
        
        foreach($request->parcalar as $parca){
            $start = intval($parca["baslangic"]);
            $end = intval($parca["bitis"]);
            $name = $parca["isim"];
            $dosya = "public/ilahiler/".$name."-".$kayit->id.".mp3";
            $ilahiler = array();
            $media->addFilter(
                        new FFMpeg\Filters\Audio\AudioClipFilter(
                            FFMpeg\Coordinate\TimeCode::fromSeconds($start),
                            FFMpeg\Coordinate\TimeCode::fromSeconds($end - $start)
                            )
                        )
                    ->addFilter(
                        new FFMpeg\Filters\Audio\AddMetadataFilter(["title"=>$name])
                        )
                    ->export()
                    ->inFormat(
                        new FFMpeg\Format\Audio\Mp3
                        )
                    ->save($dosya);
                    
            
            $ilahi = new Ilahi;
            $ilahi->dosya = $dosya;
            $ilahi->isim = $name;
            $ilahi->ham_kayit = $kayit->id;
            $ilahi->save();

            array_push($ilahiler,$ilahi);

        }

        return view('sayfalar.ilahiler_duzenle', ['ilahiler' => $ilahiler, 'success' => "Kayıt başarıyla eklendi."]);

    }

}
