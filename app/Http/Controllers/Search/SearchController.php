<?php

namespace App\Http\Controllers\Search;

use App\Models\Ads\Ad;
use App\Models\Common\Country;
use App\Models\Common\River;
use App\Models\Common\ShipType;
use App\Models\Settings\CargoStatus;
use App\Models\Settings\NavigationRegime;
use App\Models\Settings\NavigationZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SearchController extends Controller
{
    public function search(Request $request){



        $this->validate($request,[
            'ship_type'=> 'nullable|exists:ship_types,id',
            'date_order' => 'nullable|in:"ASC","DESC"',
            'min_weight_passengers' => 'nullable|numeric',
            'max_weight_passengers' => 'nullable|numeric',
            'ship_navigation' => 'nullable|exists:navigation_zones,id',
            'filter_image' => 'nullable|in:1',
            'min_ship_engine_power' => 'nullable|numeric',
            'max_ship_engine_power' => 'nullable|numeric',
            'ship_regime' => 'nullable|exists:navigation_regimes,id',
            'min_filter_ship_draft' => 'nullable|numeric',
            'max_filter_ship_draft' => 'nullable|numeric',
            'min_ship_length' => 'nullable|numeric',
            'max_ship_length' => 'nullable|numeric',
            'min_ship_width' => 'nullable|numeric',
            'max_ship_width' => 'nullable|numeric',
            'min_ship_height' => 'nullable|numeric',
            'max_ship_height' => 'nullable|numeric',
            'min_ship_year' => 'nullable|numeric',
            'max_ship_year' => 'nullable|numeric',
            'ship_cargo_status' => 'nullable|exists:cargo_statuses,id',
            'ship_cargo_cover' => 'nullable|in:0,1',
            'filter_crane' => 'nullable|in:0,1',
            'pavilion' => 'nullable|exists:countries,id',
            'rivers_sectors' => 'nullable',



        ]);

        $ship_type = $request->ship_type;
        $order = $request->date_order;
        $min_weight_passengers = $request->min_weight_passengers;
        $max_weight_passengers = $request->max_weight_passengers;
        $ship_navigation = $request->ship_navigation;
        $pavilion = $request->pavilion;
        $min_ship_engine_power = $request->min_ship_engine_power;
        $max_ship_engine_power = $request->max_ship_engine_power;
        $ship_regime = $request->ship_regime;
        $min_filter_ship_draft = $request->min_filter_ship_draft;
        $max_filter_ship_draft = $request->max_filter_ship_draft;
        $min_ship_length = $request->min_ship_length;
        $max_ship_length = $request->max_ship_length;
        $min_ship_width = $request->min_ship_width;
        $max_ship_width = $request->max_ship_width;
        $min_ship_height = $request->min_ship_height;
        $max_ship_height = $request->max_ship_height;
        $min_ship_year = $request->min_ship_year;
        $max_ship_year = $request->max_ship_year;
        $ship_cargo_status = $request->ship_cargo_status;
        $ship_cargo_cover = $request->ship_cargo_cover;
        $filter_crane = $request->filter_crane;
        $rivers = $request->rivers_sectors;
        $filter_image = $request->filter_image;


        $result = Ad::
            when($ship_type, function ($q) use ($ship_type) {
                return $q->where('ship_type', $ship_type);
            })->
            when($min_weight_passengers,function ($q) use ($min_weight_passengers){
                return $q->where('capacity','>=',$min_weight_passengers);
            })->

            when($max_weight_passengers,function ($q) use ($max_weight_passengers){
                return $q->where('capacity','<=',$max_weight_passengers);
            })->

            when($ship_navigation,function ($q) use ($ship_navigation){
                return $q->where('navigation_zone',$ship_navigation);
            })->

             when($pavilion,function ($q) use ($pavilion){
                            return $q->where('country_id',$pavilion);
                        })->
            when($min_ship_engine_power,function ($q) use ($min_ship_engine_power){
                return $q->where('engine_power','>=',$min_ship_engine_power);
            })->

            when($max_ship_engine_power,function ($q) use ($max_ship_engine_power){
                return $q->where('engine_power','<=',$max_ship_engine_power);
            })->

            when($ship_regime,function ($q) use ($ship_regime){
                return $q->where('navigation_regime',$ship_regime);
            })->

            when($min_filter_ship_draft,function ($q) use ($min_filter_ship_draft){
                return $q->where('draft','>=',$min_filter_ship_draft);
            })->

            when($max_filter_ship_draft,function ($q) use ($max_filter_ship_draft){
                return $q->where('draft','<=',$max_filter_ship_draft);
            })->

            when($min_ship_length,function ($q) use ($min_ship_length){
                return $q->where('length','>=',$min_ship_length);
            })->

            when($max_ship_length,function ($q) use ($max_ship_length){
                return $q->where('length','<=',$max_ship_length);
            })->

            when($min_ship_width,function ($q) use ($min_ship_width){
                return $q->where('width','>=',$min_ship_width);
            })->

            when($max_ship_width,function ($q) use ($max_ship_width){
                return $q->where('width','<=',$max_ship_width);
            })->

            when($min_ship_height,function ($q) use ($min_ship_height){
                return $q->where('height','>=',$min_ship_height);
            })->

            when($max_ship_height,function ($q) use ($max_ship_height){
                return $q->where('height','<=',$max_ship_height);
            })->

            when($min_ship_year,function ($q) use ($min_ship_year){
                return $q->where('made_year','>=',$min_ship_year);
            })->

            when($max_ship_year,function ($q) use ($max_ship_year){
                return $q->where('made_year','<=',$max_ship_year);
            })->

            when($ship_cargo_status,function ($q) use ($ship_cargo_status){
                return $q->where('cargo_status',$ship_cargo_status);
            })->

            when($ship_cargo_cover,function ($q) use ($ship_cargo_cover){
                return $q->where('cargo_cover',$ship_cargo_cover);
            })->

            when($filter_crane,function ($q) use ($filter_crane){
                return $q->where('car_crane',$filter_crane);
            })






            ->when($order, function ($q) use ($order) {
                return $q->orderBy('created_at', $order);
            })
            ->paginate(6);


         // FILTRARE RAURI
           if ($rivers){
               foreach ($result as $key => $res){

                   if (!is_array(json_decode($res->rivers)) || !array_intersect($rivers, json_decode($res->rivers) )){
                      $result->forget($key);
                   }
               }
           }


           if ($filter_image){
               foreach ($result as $key => $res){
                   if (!File::exists(public_path('upload/'.$res->image_folder)) || !File::allFiles(public_path('upload/'.$res->image_folder))){
                       $result->forget($key);
                   }
               }
           }


        $countries = Country::all();
        $rivers = River::all();
        $shipTypes = ShipType::with('Name')->get();
        $zones = NavigationZone::with('Name')->get();
        $cargostatuses = CargoStatus::with('Name')->get();
        $regimes = NavigationRegime::with('Name')->get();

       return view('toateOfertele')->with([
           'results' =>$result,
           'oldReq'    => $request,
           'countries' => $countries,
           'rivers' => $rivers,
           'ship_types' => $shipTypes,
           'zones' => $zones,
           'cargostatuses' => $cargostatuses,
           'regimes' => $regimes,

       ]);

    }
}
