<?php

namespace App\Http\Controllers\Ads;

use App\Models\Ads\Ad;
use App\Models\Common\Country;
use App\Models\Common\River;
use App\Models\Common\ShipType;
use App\Models\Settings\CargoStatus;
use App\Models\Settings\NavigationRegime;
use App\Models\Settings\NavigationZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ToateOfertele extends Controller
{
    public function index(){
        $countries = Country::all();
        $rivers = River::all();
        $shipTypes = ShipType::with('Name')->get();
        $zones = NavigationZone::with('Name')->get();
        $cargostatuses = CargoStatus::with('Name')->get();
        $regimes = NavigationRegime::with('Name')->get();
        $ads = Ad::paginate(6);

        return view('toateOfertele')->with([
            'countries' => $countries,
            'rivers' => $rivers,
            'ship_types' => $shipTypes,
            'zones' => $zones,
            'cargostatuses' => $cargostatuses,
            'regimes' => $regimes,
            'results' => $ads
        ]);
    }
}
