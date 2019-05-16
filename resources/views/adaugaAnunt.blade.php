<?php
        $name = 'name_'.app()->getLocale();
?>
@extends('layouts.app')
@section('customcss')
    <link href="/css/customaddAd.css?v=1.2" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

    <style>

    </style>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                {!! Form::open([
                        "class" => "dropzone",
                         "id" => "my-awesome-dropzone",
                         'files' => true,
                         'action' => 'Ads\AnuntController@SaveEditAd'
                    ]) !!}
                <input type="hidden" name="folder_name" value="{!! $folder !!}">

                @if(!empty($ad))

                    <input type="hidden" name="ad_id" value="{!! $ad->id !!}">
                @endif
                <table class="on2" id="on2">

                    <tbody>
                    <tr>
                        <td><b>@lang('addAd.ship_type')</b></td>
                        <td>
                            <select required name="ship_type"  class="form-control form-control-sm {!! ($errors->has('ship_type')) ? 'is-invalid' : '' !!}" id="ship_type">
                                <option value="">@lang('addAd.select')</option>
                                @foreach($ship_types as $shiptype)

                                    <option {!! (old('ship_type') == $shiptype->id) || (!empty($ad) && $ad->ship_type == $shiptype->id) ?  'selected' : '' !!} value="{!! $shiptype->id !!}" >{!! !empty($shiptype->name[0]->name) ?  $shiptype->name[0]->name : $shiptype->FallBackName->name !!}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> <b>@lang('addAd.ship_name')</b> </td>
                        <td>
                            <input required class="form-control form-control-sm {!! ($errors->has('ship_name')) ? 'is-invalid' : '' !!}" value="{!! !empty($ad) ? $ad->ship_name : old('ship_name') !!}" name="ship_name" type="text" placeholder="TAURUS 2" />

                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.eni_no')</td>
                        <td>
                            <input required name="numar_identificare" type="text" class="form-control form-control-sm {!! ($errors->has('numar_identificare')) ? 'is-invalid' : '' !!}" placeholder="01234567891011" size="22" maxlength="20" value="{!! !empty($ad) ? $ad->imo : old('numar_identificare') !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <td> <b>@lang('addAd.pavilion') </b></td>
                        <td>
                            <select required name="country" class="form-control form-control-sm {!! ($errors->has('numar_identificare')) ? 'is-invalid' : '' !!}" >
                                <option value="">Select</option>
                                @foreach($countries as $country)

                                    <option {!! (old('country') == $country->id) || (!empty($ad) && $ad->country_id == $country->id)  ?  'selected' : '' !!} value="{!! $country->id !!}">{!! $country->name !!}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_year')</td>
                        <td>
                            <input required name="an_contructie" value="{!! !empty($ad) ? $ad->made_year : old('an_contructie') !!}" type="text" placeholder="1998" class="form-control form-control-sm {!! ($errors->has('an_contructie')) ? 'is-invalid' : '' !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>  <b id="tonaj_label"> @lang('addAd.ship_weight')</b></td>
                        <td>
                            <input  required class="form-control form-control-sm {!! ($errors->has('tonaj')) ? 'is-invalid' : '' !!}" type="text"  id="tonaj" name="tonaj" placeholder="Selectati intai tipul de nava" value="{!! !empty($ad) ? $ad->capacity : old('tonaj') !!}" {!! !empty($ad) || old('tonaj') ? '' : 'readonly' !!}/>

                    </tr>
                    <tr>
                        <td> <b>@lang('addAd.ship_navigation')</b> </td>
                        <td>
                            <select required name="zona_navigatie" id="zona" class="form-control form-control-sm {!! ($errors->has('zona_navigatie')) ? 'is-invalid' : '' !!}">
                                <option value="">@lang('addAd.select')</option>
                                @foreach($zones as $zone)

                                    <option {!! (old('zona_navigatie') == $zone->id) || (!empty($ad) && $ad->navigation_zone == $zone->id) ? 'selected' : '' !!} value="{!! $zone->id !!}" >{!! !empty($zone->name[0]->name) ?  $zone->name[0]->name : $zone->FallBackName->name !!}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_length')</td>
                        <td><input class="form-control form-control-sm smallInput {!! ($errors->has('lungime')) ? 'is-invalid' : '' !!}" name="lungime" type="text" placeholder="123.00"  value="{!! !empty($ad) ? $ad->length : old('lungime') !!}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_width')</td>
                        <td><input name="latime" class="form-control form-control-sm smallInput {!! ($errors->has('latime')) ? 'is-invalid' : '' !!}" type="text" placeholder="24.00" size="6"  value="{!! !empty($ad) ? $ad->width : old('latime') !!}" required>
                        </td>
                    </tr>
                    <tr>
                        <td> @lang('addAd.ship_height')</td>
                        <td><input name="inaltime" class="form-control form-control-sm smallInput {!! ($errors->has('inaltime')) ? 'is-invalid' : '' !!}" type="text" placeholder="18.00" size="6"  value="{!! !empty($ad) ? $ad->height : old('inaltime') !!}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_draft')</td>
                        <td><input class="form-control form-control-sm smallInput {!! ($errors->has('pescaj')) ? 'is-invalid' : '' !!}" name="pescaj" type="text" placeholder="10.00" size="6" value="{!! !empty($ad) ? $ad->draft : old('pescaj') !!}">
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_engine_power')</td>
                        <td>
                            <input required class="form-control form-control-sm smallInput {!! ($errors->has('putere_motor')) ? 'is-invalid' : '' !!}" name="putere_motor" type="text" placeholder="8500" size="9" maxlength="6" value="{!! !empty($ad) ? $ad->engine_power : old('putere_motor') !!}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @lang('addAd.ship_cargo_status') <br>
                            <small style="font-weight: 700">@lang('addAd.select_only_if')</small>
                        </td>
                        <td>
                            <select class="form-control form-control-sm" name="stare_magazii"  id="stare_magazii" >
                                <option value="" selected="selected">@lang('addAd.select')</option>
                                @foreach($cargostatuses as $cargostatus)

                                    <option {!! (old('stare_magazii') == $cargostatus->id) || (!empty($ad) && $ad->cargo_status == $cargostatus->id) ? 'selected' : '' !!} value="{!! $cargostatus->id !!}" >{!! !empty($cargostatus->name[0]->name) ?  $cargostatus->name[0]->name : $cargostatus->FallBackName->name !!}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @lang('addAd.ship_cargo_cover') <br>
                            <small style="font-weight: 700">@lang('addAd.select_only_if')</small>
                        </td>
                        <td>
                            <select name="capace_magazii"  class="form-control form-control-sm" id="capace_magazii">
                                <option value="">@lang('addAd.select')</option>

                                <option {!! (old('capace_magazii') === 1) || (!empty($ad) && $ad->cargo_cover == 1) ? 'selected' : '' !!} value="1">@lang('addAd.yes')</option>
                                <option {!! (old('capace_magazii') === 0) || (!empty($ad) && $ad->cargo_cover == 0) ? 'selected' : '' !!} value="0">@lang('addAd.no')</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_regime')</td>
                        <td>
                            <select required name="regim_navigatie" class="form-control form-control-sm {!! ($errors->has('regim_navigatie')) ? 'is-invalid' : '' !!}" >
                                <option value="">@lang('addAd.select')</option>
                                @foreach($regimes as $regime)

                                    <option {!! (old('regim_navigatie') == $regime->id) || (!empty($ad) && $ad->navigation_regime == $regime->id) ? 'selected' : '' !!} value="{!! $regime->id !!}" >{!! !empty($regime->name[0]->name) ?  $regime->name[0]->name : $regime->FallBackName->name !!}</option>

                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>

                        <td>@lang('addAd.ship_crane')

                        <td><select name="macara" class="form-control form-control-sm {!! ($errors->has('macara')) ? 'is-invalid' : '' !!}" >
                                <option value="" >@lang('addAd.select')</option>
                                <option {!!  old('macara') === 1 || (!empty($ad) && $ad->car_crane == 1) ? 'selected' : '' !!} value="1">@lang('addAd.yes')</option>
                                <option {!! old('macara') === 0 || (!empty($ad) && $ad->car_crane == 0) ? 'selected' : '' !!} value="0">@lang('addAd.no')</option>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>@lang('addAd.ship_crew')</td>
                        <td><input required class="form-control form-control-sm smallInput {!! ($errors->has('echipaj')) ? 'is-invalid' : '' !!}" name="echipaj" type="text" placeholder="23" size="7" maxlength="4" value="{!! !empty($ad) ? $ad->crew : old('echipaj') !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('addAd.ship_owner')</td>
                        <td><input  required class="form-control form-control-sm {!! ($errors->has('nume')) ? 'is-invalid' : '' !!}" type="text" size="30" maxlength="40" name="nume" value="{!! !empty($ad) ? $ad->owner_name : old('nume') !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>@lang('auth.email')</td>
                        <td><input class="form-control form-control-sm" size="30" type=email   value="{!! !empty($ad) ? $ad->owner_email : !old('email') ? Auth::user()->email : old('email') !!}" name="email"></td>
                    </tr>

                    <tr>
                        <td>@lang('addAd.owner_phone')</td>
                        <td><input class="form-control form-control-sm {!! ($errors->has('telefon')) ? 'is-invalid' : '' !!}" value="{!! !empty($ad) ? $ad->phone : old('telefon') !!}" required name="telefon" type="text" size= "30">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="row ">
                                <div class="col-12 text-center">
                                    <legend>@lang('addAd.select_rivers')</legend>
                                </div>
                            </div>
                            <div class="container-fluid">
    <div class="row" style="margin-left: 20px;">
                                @foreach($rivers as $river)
                                    <div class="col-4">
                                        <input type="checkbox" class="form-check-input fluvii" {!!

                                       ( (is_array(old('rivers')) && in_array( $river->id, old('rivers'))) ) ||
                                       (!empty($ad) && is_array($selected_rivers) && in_array( $river->id, $selected_rivers) )

                                        ?

                                        'checked' :

                                        ''

                                        !!}  name="rivers[]" value="{!! $river->id !!}">{!! !empty($river->name[0]->name) ?  $river->name[0]->name : $river->FallBackName->name !!}
                                    </div>
                                    @endforeach
                                    <div class="col-4">
                                        <input type="checkbox" class="form-check-input" class="fluvii" id="select_all_rivers">@lang('addAd.select_all')
                                    </div>
                            </div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <div class="file-loading">
                                <input id="file-1" type="file" name="file"  data-overwrite-initial="false" hidden data-browse-on-zone-click="true" data-min-file-count="1">
                            </div>

                        </td>

                    </tr>

                    <tr>
                        <td><div align="center">@lang('addAd.mesage')</div></td>
                        <td><textarea class="form-control" name="detalii" cols="56" rows="4" id="textarea" >{!! !empty($ad) ? $ad->description :old('detalii') !!}</textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                                <div align="center">
                                    <input required name="terms" type="checkbox" checked="checked" />
                                </div>
                                <label for="checkbox">
                                    <div align="center">@lang('addAd.terms')</div>
                                </label>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><div align="center"><button class="btn {!! $submitclass !!}"  type="submit" id="submitForm" >{!! $action !!}</button></div></td>
                    </tr>
                    </tbody>

                </table>{!! Form::close() !!}



            </div>


            <div class="col-6">




                <p class="event_patru">ANUNTURILE TALE</p>
                <div class="row">
                    @if(!count($ads))
                        <div class="col-6 offset-3 text-center">
                            <h3>@lang('addAd.no_ads')</h3>
                        </div>
                    @else

                        @foreach($ads as $ad)
                        <div class="col-6">
                            <table class="on8" width="400" border="0" >
                                <tr>
                                    <?php
                                    $imagesArrs = array();
                                    if(File::exists(public_path('upload/'.$ad->image_folder))) {
                                        $imagesAd = File::files(public_path('upload/'.$ad->image_folder)); // this is recursive

                                        foreach($imagesAd as $path) {

                                            array_push($imagesArrs,pathinfo($path)['basename']);
                                        }
                                    }

                                    ?>
                                    <th scope="col"><img src="{!! !empty($imagesArrs[0]) ? "/upload/$ad->image_folder/$imagesArrs[0]" : '/img/no-pic.png' !!}" alt="" border=3 height=188 width=400></th>
                                </tr>
                                <tr>
                                    <td valign="top" align="left"><p>@lang('addAd.ship_type'): {!! empty($ad->Type->Name->name) ? $ad->Type->FallBackName->name : $ad->Type->Name->name !!}<br />
                                            @lang('addAd.pavilion'):    {!! $ad->Country->name !!}<br />
                                            {!! $ad->Type->TonajType->$name !!}: {!! $ad->capacity !!} <br />
                                            @lang('addAd.ship_navigation'): {!! empty($ad->NavigationZone->Name->name) ? $ad->NavigationZone->FallBackName->name : $ad->NavigationZone->Name->name !!}
                                            &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top" align="left">
                                        <div align="center">
                                            <a href="/editeazaAnunt/{!! $ad->id !!}" class="btn btn-warning">@lang('addAd.edit')</a>
                                            <a href="/deleteAd/{!! $ad->id !!}" class="btn btn-danger">@lang('addAd.delete')</a>
                                        </div>
                                    </td>
                                </tr>


                            </table>
                            <br>
                        </div>
                    @endforeach
                    @endif



                </div>





            </div>
        </div>
    </div>
@endsection
@section('customJS')
    <script src="/incs/ImgUpload/imageuploadify.min.js"></script>
    <script src="/incs/jquery.multiselect.js"></script>
    <script src="/js/locales/ro.js?v=1" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            /*Grafic dashboard*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            @if(!empty($ad))
                $('#ship_type').change();
            @endif

        });



        let js_array =  [<?php echo '"'.implode('","', $images).'"' ?>];

        let imagesArr = [];
        let deleteKeys = []
        $.each(js_array,function (key,val) {
            if (!val){
                return true;
            }
            imagesArr.push('<img class="kv-preview-data file-preview-image" src="/public/upload/{!! $folder !!}/'+val+'">')
            deleteKeys.push({key: val})

        })



        if (imagesArr.length == 0){
            imagesArr == false;
            deleteKeys = false;
        }


        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/saveImage/{!! $folder !!}",
            language: "{!! app()->getLocale() !!}",
            initialPreview: imagesArr,
            initialPreviewConfig: deleteKeys,
            showUpload: false,
            showRemove: false,
            showBrowse: false,
            showCaption: false,

            allowedFileExtensions: ['jpg', 'png','jpeg'],
            overwriteInitial: false,
            validateInitialCount:true,
            maxFileSize:2048,
            maxFilePreviewSize:2048,
            uploadAsync: false,
            maxFileCount: 6,
            initialPreviewAsData: false,
            deleteUrl: "/deleteImage/{!! $folder !!}",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            },


        }).on("filebatchselected", function(event, files) {
            $("#file-1").fileinput("upload");
        });
        ;


        /*$(function () {
            $('select[multiple].active.3col').multiselect({
                columns: 1,
                placeholder: '@lang('addAd.select')',
                search: true,
                searchOptions: {
                    'default': '@lang('addAd.select')'
                },
                selectAll: true
            });

        });*/


        $('#zona').change(function () {
           let val = $(this).val()

           if (val == 3) {
               console.log(val)
                $('.fluvii').attr('disabled','disabled')
                $('#select_all_rivers').attr('disabled','disabled')
           }else {
               $('.fluvii').attr('disabled',false)
               $('#select_all_rivers').attr('disabled',false)
           }
        })


        $('#ship_type').change(function () {
            let type = $(this).val()


            $.ajax({
                url: "/getTonajType",
                type:"POST",
                data: { type: type },
                success:function(data){
                    console.log(data)
                    $('#tonaj_label').text(data.name)
                        if (data.id == 4 || data.id == 5){
                            $('#tonaj').attr('readonly',false).attr('placeholder','1234');
                        } else{
                            $('#tonaj').attr('readonly',false).attr('placeholder','1234.00');
                        }
                        
                        if (!data.cargo) {
                           $('#capace_magazii').attr('disabled',true)
                           $('#stare_magazii').attr('disabled',true)
                        }else {
                            $('#capace_magazii').attr('disabled',false)
                            $('#stare_magazii').attr('disabled',false)
                        }

                },error:function(){

                }
            }); //end of ajax

        })

        $('#select_all_rivers').change(function () {
            if($("#select_all_rivers").is(':checked'))
               $('.fluvii').attr('checked',true)
            else
                $('.fluvii').attr('checked',false)
        })



    </script>
@endsection