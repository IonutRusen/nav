<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function Country(){
        return $this->hasOne('App\Models\Common\Country','id','country_id');
    }

    public function Type(){
        return $this->hasOne('App\Models\Common\ShipType','id','ship_type');
    }
    public function NavigationZone(){
        return $this->hasOne('App\Models\Settings\NavigationZone','id','navigation_zone');
    }

    public function Owner(){
        return $this->hasOne('App\User','id','owner_id');
    }


}
