<?php

namespace App\Models\Common;

use App\Models\Settings\Language;
use Illuminate\Database\Eloquent\Model;

class ShipType extends Model
{
    public function Name(){
        return $this->hasMany('App\Models\Common\ShipTypeName','ship_type','id')->where('language_id',Language::where('abbr', app()->getLocale())->first()->id);
    }


    public function FallBackName(){
        return $this->hasOne('App\Models\Common\ShipTypeName','ship_type','id')->where('language_id','2');
    }

    public function TonajType(){
        return $this->hasOne('App\Models\Settings\TonajType','id','tonaj_type');
    }


}
