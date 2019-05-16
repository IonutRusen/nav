<?php

namespace App\Models\Common;

use App\Models\Settings\Language;
use Illuminate\Database\Eloquent\Model;

class River extends Model
{
    public function Name(){
        return $this->hasMany('App\Models\Common\RiverName','river_id','id')->where('language_id',Language::where('abbr', app()->getLocale())->first()->id);
    }


    public function FallBackName(){
        return $this->hasOne('App\Models\Common\RiverName','river_id','id')->where('language_id','2');
    }
}
