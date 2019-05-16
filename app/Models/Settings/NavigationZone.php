<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class NavigationZone extends Model
{
    public function Name(){
        return $this->hasMany('App\Models\Settings\NavogationZoneName','zone_id','id')->where('language_id',Language::where('abbr', app()->getLocale())->first()->id);
    }


    public function FallBackName(){
        return $this->hasOne('App\Models\Settings\NavogationZoneName','zone_id','id')->where('language_id','2');
    }
}
