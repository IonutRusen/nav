<?php

namespace App\Http\Controllers\Ads;

use App\Models\Ads\Ad;
use App\Models\Common\Country;
use App\Models\Common\River;
use App\Models\Common\ShipType;
use App\Models\Common\ShipTypeName;
use App\Models\Settings\CargoStatus;
use App\Models\Settings\NavigationRegime;
use App\Models\Settings\NavigationZone;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Lang;
use Vinkla\Hashids\Facades\Hashids;

class AnuntController extends Controller
{
    public function index($folder){

        $countries = Country::all();
        $imagesArr = array();

        if(File::exists(public_path('upload/'.$folder))) {
            $images = File::files(public_path('upload/'.$folder)); // this is recursive

            foreach($images as $path) {

                array_push($imagesArr,pathinfo($path)['basename']);
            }
        }



            // var_dump(Language::where('abbr', app()->getLocale())->first()->id);
       $shipTypes = ShipType::with('Name')->get();
       $rivers = River::with('Name')->get();
       $zones = NavigationZone::with('Name')->get();
       $cargostatuses = CargoStatus::with('Name')->get();
       $regimes = NavigationRegime::with('Name')->get();


    foreach ($shipTypes as $shipType){
        if (!$shipType->name->count()){
                $shipType->FallBackName;
           }
       }

    foreach ($rivers as $river){
        if (!$river->name->count()){
               $river->FallBackName;
           }
       }
    foreach ($zones as $zone){
        if (!$zone->name->count()){
              $zone->FallBackName;
           }
        }
    foreach ($cargostatuses as $cargostatus){
        if (!$cargostatus->name->count()){
              $cargostatus->FallBackName;
           }
        }

    foreach ($regimes as $regime){
        if (!$regime->name->count()){
              $regime->FallBackName;
           }
        }



        return view('adaugaAnunt')->with(
            [
                'countries'=> $countries,
                'ship_types' => $shipTypes,
                'rivers' => $rivers,
                'folder' => $folder,
                'images' => $imagesArr,
                'zones' => $zones,
                'cargostatuses' => $cargostatuses,
                'regimes' => $regimes,
                'ads'    => \Auth::user()->Ads,
                'action' => Lang::get('addAd.save'),
                'submitclass' => 'btn-primary'
                ]
        );
    }


    public function editAdd($id){

        $ad = Ad::find($id);
        $folder = $ad->image_folder;
        $countries = Country::all();
        $imagesArr = array();


        if(File::exists(public_path('upload/'.$folder))) {
            $images = File::files(public_path('upload/'.$folder)); // this is recursive

            foreach($images as $path) {

                array_push($imagesArr,pathinfo($path)['basename']);
            }
        }



        // var_dump(Language::where('abbr', app()->getLocale())->first()->id);
        $shipTypes = ShipType::with('Name')->get();
        $rivers = River::with('Name')->get();
        $zones = NavigationZone::with('Name')->get();
        $cargostatuses = CargoStatus::with('Name')->get();
        $regimes = NavigationRegime::with('Name')->get();


        foreach ($shipTypes as $shipType){
            if (!$shipType->name->count()){
                $shipType->FallBackName;
            }
        }

        foreach ($rivers as $river){
            if (!$river->name->count()){
                $river->FallBackName;
            }
        }
        foreach ($zones as $zone){
            if (!$zone->name->count()){
                $zone->FallBackName;
            }
        }
        foreach ($cargostatuses as $cargostatus){
            if (!$cargostatus->name->count()){
                $cargostatus->FallBackName;
            }
        }

        foreach ($regimes as $regime){
            if (!$regime->name->count()){
                $regime->FallBackName;
            }
        }



        return view('adaugaAnunt')->with(
            [
                'ad' => $ad,
                'countries'=> $countries,
                'ship_types' => $shipTypes,
                'rivers' => $rivers,
                'folder' => $folder,
                'images' => $imagesArr,
                'zones' => $zones,
                'cargostatuses' => $cargostatuses,
                'regimes' => $regimes,
                'ads'    => \Auth::user()->Ads->where('id', '!=', $ad->id),
                'selected_rivers' => json_decode($ad->rivers),
                'action' => Lang::get('addAd.edit'),
                'submitclass' => 'btn-warning'
            ]
        );
    }


    public function SaveEditAd(Request $request){

        $this->validate($request,[
              'ship_type'=> 'required|exists:ship_types,id',
              'ship_name'=> 'required',
              'numar_identificare'=> 'required',
              'country'=> 'required|exists:countries,id',
              'an_contructie'=> 'required|numeric',
              'tonaj'=> 'required|integer',
              'zona_navigatie'=> 'required|exists:navigation_zones,id',
              'lungime'=> 'required|numeric',
              'latime'=> 'required|numeric',
              'inaltime'=> 'required|numeric',
              'pescaj'=> 'numeric',
              'putere_motor'=> 'required|numeric',
              'stare_magazii'=> 'integer',
              'capace_magazii'=> 'min:0|max:1',
              'regim_navigatie'=> 'required|exists:navigation_regimes,id',
              'macara'=> 'integer|min:0|max:1',
              'echipaj'=> 'required|integer',
              'nume'=> 'required',
              'folder_name'=> 'required',
              'email'=> 'email',
              'telefon'=> 'required|numeric',
              'ad_id' => 'sometimes|exists:ads,id'


        ]);

        if ($request->ad_id){
            $ad = Ad::find($request->ad_id);
        }else{
            $ad = new Ad();
        }


            $ad->image_folder = $request->folder_name;
            $ad->owner_id = \Auth::id();
            $ad->ship_type = $request->ship_type;
            $ad->ship_name = $request->ship_name;
            $ad->imo = $request->numar_identificare;
            $ad->country_id = $request->country;
            $ad->made_year = $request->an_contructie;
            $ad->capacity = $request->tonaj;
            $ad->navigation_zone = $request->zona_navigatie;
            $ad->length = $request->lungime;
            $ad->width = $request->latime;
            $ad->height = $request->inaltime;
            $ad->draft = $request->pescaj;
            $ad->engine_power = $request->putere_motor;
            $ad->cargo_status = $request->stare_magazii;
            $ad->cargo_cover = $request->capace_magazii;
            $ad->navigation_regime = $request->regim_navigatie;
            $ad->car_crane = $request->macara;
            $ad->crew = $request->echipaj;
            $ad->owner_name = $request->nume;
            $ad->owner_email = $request->email;
            $ad->phone = $request->telefon;
            $ad->rivers = json_encode($request->rivers);
            $ad->description = $request->detalii;

        if ($request->ad_id){
            $ad->update();
        }else{
            $ad->save();
        }


        return redirect("/adaugaAnunt/".substr(md5(microtime()),rand(0,26),5));

    }


    public function store($id,Request $request)
    {
        $imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('upload/'.$id), $imageName);


        return response()->json(['uploaded' => '/upload/'.$imageName]);
    }

    public function delete($id,Request $request){

        \Log::info($request->key);
        $destinationPath = public_path('upload/'.$id.'/'.$request->key);
        File::delete($destinationPath);
        return $request->all();
    }

    public function tonajType(Request $request){
        //return $request->all();
        $name = 'name_'.app()->getLocale();
        $ship = ShipType::find($request->type);
        return [
            'name' => $ship->TonajType->$name,
            'id' => $ship->TonajType->id,
            'cargo' => $ship->cargo_type
        ];
    }


    public function test(){
        return Hashids::encode(4815162342);
    }

    public function deleteAd($id){
       $ad = Ad::find($id);


        File::deleteDirectory(public_path('upload/'.$ad->image_folder));

        $ad->delete();

        return redirect()->back();
    }


    public function getContactDetails(Request $request){
        $ad = Ad::with('Owner')->where('id', $request->id)->first();
        return $ad;
    }
}
