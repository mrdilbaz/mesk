<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HamKayit extends Model
{
    //
    protected $guarded = [];
    
    public function tipisim(){
        return HamKayitTip::find($this->tip)->tip;
    }
}
