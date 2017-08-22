<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HamKayit extends Model
{
    //
    protected $guarded = [];
    
    public function tip(){
        return $this->belongsTo('App\HamKayitTip','tip');
    }
}
