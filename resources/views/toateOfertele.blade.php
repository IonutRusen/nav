{{--@if($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif--}}
@extends('layouts.app')
@section('customcss')
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/custom.css?v=4" rel="stylesheet" type="text/css">
    <link href="/incs/jquery.multiselect.css?v=1.2" rel="stylesheet" />

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <div class="col-12 text-center">

                    <a class="btn btn-primary" href="/adaugaAnunt/{!! substr(md5(microtime()),rand(0,26),5); !!}"><b>@lang('addAd.add_new')</b></a>
                </div>
                <div class="row d-inline">

                </div>


                <div class="col-12" >
                    <p class="event_desc">@lang('addAd.search_for')</p>
                    {!! Form::open([
                        'action' => 'Search\SearchController@search'
                    ]) !!}
                    <table class="on" bgcolor="#00FF00">
                        <tbody>
                        <tr>
                            <th scope="col">@lang('addAd.date_order')</th>
                            <th scope="col">
                                <select name="date_order" class="form-control-sm {!! ($errors->has('date_order')) ? 'is-invalid' : '' !!}">
                                    <option value="" >@lang('addAd.select')</option>
                                    <option {!! (!empty($oldReq) && $oldReq->date_order == 'ASC' ) || (old('date_order') == 'ASC') ? 'selected' : '' !!} value="ASC">@lang('addAd.ascending')</option>
                                    <option {!! (!empty($oldReq) && $oldReq->date_order == 'DESC' ) || (old('date_order') == 'DESC') ? 'selected' : '' !!} value="DESC">@lang('addAd.descending')</option>

                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_type')
                            </th>
                            <th scope="col">
                                <select name="ship_type" class="form-control-sm {!! ($errors->has('ship_type')) ? 'is-invalid' : '' !!}">
                                    <option value="">@lang('addAd.select')</option>
                                    @foreach($ship_types as $shiptype)

                                        <option {!! (!empty($oldReq) && $oldReq->ship_type == $shiptype->id) || ( (old('ship_type') == $shiptype->id) || (!empty($ad) && $ad->ship_type == $shiptype->id) )?  'selected' : '' !!} value="{!! $shiptype->id !!}" >{!! !empty($shiptype->name[0]->name) ?  $shiptype->name[0]->name : $shiptype->FallBackName->name !!}</option>
                                    @endforeach

                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.weight_passengers')
                            </th>
                            <th scope="col">
                                @lang('addAd.min')
                                <input class="form-control-sm {!! ($errors->has('min_weight_passengers')) ? 'is-invalid' : '' !!}" type="text" size="10" name="min_weight_passengers" value="{!! !empty($oldReq->min_weight_passengers) ?  $oldReq->min_weight_passengers : old('min_weight_passengers')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_weight_passengers')) ? 'is-invalid' : '' !!}" name="max_weight_passengers" value="{!! !empty($oldReq->max_weight_passengers) ?  $oldReq->max_weight_passengers : old('max_weight_passengers')  !!}">

                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_navigation')
                            </th>
                            <th scope="col">

                                    <select name="ship_navigation" id="zona" class="form-control-sm {!! ($errors->has('ship_navigation')) ? 'is-invalid' : '' !!}">
                                        <option value="">@lang('addAd.select')</option>
                                        @foreach($zones as $zone)

                                            <option {!! ( !empty($oldReq->ship_navigation) && $oldReq->ship_navigation == $zone->id ) || old('ship_navigation') == $zone->id ? 'selected' : '' !!} value="{!! $zone->id !!}" >{!! !empty($zone->name[0]->name) ?  $zone->name[0]->name : $zone->FallBackName->name !!}</option>
                                        @endforeach
                                    </select>

                            </th>
                        </tr>
                        <tr>
                            <th scope="col">@lang('addAd.rivers_sectors')  </th>

                            <th scope="col">
                                <select name="rivers_sectors[]" multiple="MULTIPLE" class="form-control-sm 3col active "  style="width:249px;"  >

                                    @foreach($rivers as $river)
                                        <option {!! (!empty($oldReq->rivers_sectors) && in_array($river->id,$oldReq->rivers_sectors)) || (old('rivers_sectors') && in_array($river->id,old('rivers_sectors'))) ? 'selected' : '' !!} value="{!! $river->id !!}"> {!! !empty($river->name[0]->name) ?  $river->name[0]->name : $river->FallBackName->name !!}</option>

                                    @endforeach

                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.pavilion')
                            </th>
                            <th scope="col">
                                <select name="pavilion" class="form-control-sm {!! ($errors->has('pavilion')) ? 'is-invalid' : '' !!}">
                                    <option value="" >@lang('addAd.select')</option>
                                    @foreach($countries as $country)
                                        <option {!! ( !empty($oldReq->pavilion) && $oldReq->pavilion == $country->id ) || old('pavilion') == $country->id ? 'selected' : '' !!}  value="{!! $country->id !!}" >{!! $country->name !!}</option>
                                    @endforeach


                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.filter_image')
                            </th>
                            <th scope="col">
                                <select name="filter_image" id="select" class="form-control-sm {!! ($errors->has('filter_image')) ? 'is-invalid' : '' !!}">

                                    <option  value="">@lang('addAd.all') </option>
                                    <option {!! ( !empty($oldReq->filter_image) && $oldReq->filter_image == 1 ) || old('filter_image') == 1 ? 'selected' : '' !!} value="1">@lang('addAd.pictures_only') </option>

                                </select>
                            </th></tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_engine_power')
                            </th>
                            <th scope="col">@lang('addAd.min')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('min_ship_engine_power')) ? 'is-invalid' : '' !!}" name="min_ship_engine_power" value="{!! !empty($oldReq->min_ship_engine_power) ?  $oldReq->min_ship_engine_power : old('min_ship_engine_power')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_ship_engine_power')) ? 'is-invalid' : '' !!}" name="max_ship_engine_power" value="{!! !empty($oldReq->max_ship_engine_power) ?  $oldReq->max_ship_engine_power : old('max_ship_engine_power')  !!}">

                            </th></tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_regime')
                            </th>
                            <th scope="col">
                                <select name="ship_regime" class="form-control-sm {!! ($errors->has('ship_regime')) ? 'is-invalid' : '' !!}">
                                    <option value="">@lang('addAd.select')</option>
                                    @foreach($regimes as $regime)

                                        <option {!! ( !empty($oldReq->ship_regime) && $oldReq->ship_regime == $regime->id ) || old('ship_regime') == $regime->id ? 'selected' : '' !!} value="{!! $regime->id !!}" >{!! !empty($regime->name[0]->name) ?  $regime->name[0]->name : $regime->FallBackName->name !!}</option>

                                    @endforeach
                                </select>
                            </th></tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.filter_ship_draft')
                            </th>
                            <th scope="col">
                                @lang('addAd.min')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('min_filter_ship_draft')) ? 'is-invalid' : '' !!}" name="min_filter_ship_draft" value="{!! !empty($oldReq->min_filter_ship_draft) ?  $oldReq->min_filter_ship_draft : old('min_filter_ship_draft')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_filter_ship_draft')) ? 'is-invalid' : '' !!}" name="max_filter_ship_draft" value="{!! !empty($oldReq->max_filter_ship_draft) ?  $oldReq->min_filter_ship_draft : old('max_filter_ship_draft')  !!}">


                            </th></tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_length')
                            </th>
                            <th scope="col">@lang('addAd.min')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('min_ship_length')) ? 'is-invalid' : '' !!}" name="min_ship_length" value="{!! !empty($oldReq->min_ship_length) ?  $oldReq->min_ship_length : old('min_ship_length')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_ship_length')) ? 'is-invalid' : '' !!}" name="max_ship_length" value="{!! !empty($oldReq->max_ship_length) ?  $oldReq->max_ship_length : old('max_ship_length')  !!}">

                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_width')
                            </th>
                            <th scope="col">@lang('addAd.min')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('min_ship_width')) ? 'is-invalid' : '' !!}" name="min_ship_width" value="{!! !empty($oldReq->min_ship_width) ?  $oldReq->min_ship_width : old('min_ship_width')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_ship_width')) ? 'is-invalid' : '' !!}" name="max_ship_width" value="{!! !empty($oldReq->max_ship_width) ?  $oldReq->max_ship_width : old('max_ship_width')  !!}">

                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_height')
                            </th>
                            <th scope="col">@lang('addAd.min')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('min_ship_height')) ? 'is-invalid' : '' !!}" name="min_ship_height" value="{!! !empty($oldReq->min_ship_height) ?  $oldReq->min_ship_height : old('min_ship_height')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_ship_height')) ? 'is-invalid' : '' !!}" name="max_ship_height" value="{!! !empty($oldReq->max_ship_height) ?  $oldReq->max_ship_height : old('max_ship_height')  !!}">

                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_year')
                            </th>
                            <th scope="col">@lang('addAd.min')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('min_ship_year')) ? 'is-invalid' : '' !!}" name="min_ship_year" value="{!! !empty($oldReq->min_ship_year) ?  $oldReq->min_ship_year : old('min_ship_year')  !!}">
                                @lang('addAd.max')
                                <input type="text" size="10" class="form-control-sm {!! ($errors->has('max_min_ship_year')) ? 'is-invalid' : '' !!}" name="max_min_ship_year" value="{!! !empty($oldReq->max_min_ship_year) ?  $oldReq->max_min_ship_year : old('max_min_ship_year')  !!}">

                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_cargo_status')
                            </th>
                            <th scope="col">
                                <select name="ship_cargo_status" class="form-control-sm {!! ($errors->has('ship_cargo_status')) ? 'is-invalid' : '' !!}">
                                    <option value="" >@lang('addAd.select')</option>
                                    @foreach($cargostatuses as $cargostatus)

                                        <option {!! ( !empty($oldReq->ship_cargo_status) && $oldReq->ship_cargo_status == $cargostatus->id ) || old('ship_cargo_status') == $cargostatus->id ? 'selected' : '' !!} value="{!! $cargostatus->id !!}" >{!! !empty($cargostatus->name[0]->name) ?  $cargostatus->name[0]->name : $cargostatus->FallBackName->name !!}</option>
                                    @endforeach
                                </select>
                            </th></tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.ship_cargo_cover')
                            </th>
                            <th scope="col"><select name="ship_cargo_cover" class="form-control-sm {!! ($errors->has('ship_cargo_cover')) ? 'is-invalid' : '' !!}">

                                    <option value="">@lang('addAd.no')</option>

                                    <option {!! ( !empty($oldReq->ship_cargo_cover) && $oldReq->ship_cargo_cover == 1 ) || old('ship_cargo_cover') == 1 ? 'selected' : '' !!}  value="1">@lang('addAd.yes')</option>

                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">
                                @lang('addAd.filter_crane')
                            </th>
                            <th scope="col">
                                <select name="filter_crane" class="form-control-sm {!! ($errors->has('filter_crane')) ? 'is-invalid' : '' !!}">
                                    <option value="" >@lang('addAd.no')</option>
                                    <option value="1" {!! ( !empty($oldReq->filter_crane) && $oldReq->filter_crane == 1 ) || old('filter_crane') == 1 ? 'selected' : '' !!}>@lang('addAd.yes')</option>


                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" scope="row"><div align="center">
                                    <button type="submit" class="btn btn-primary">@lang('addAd.search')</button>
                                </div></th>
                        </tr>
                        </tbody>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>


            <div class="col-7 ">
                <div class="row">

                @if(empty($results) || $results->isEmpty())

                       <div class="col-12 text-center">
                           <h3>@lang('addAd.no_results')</h3>
                       </div>
                @else
                        @foreach($results as $result)
                            <?php
                            $imagesArrs = array();
                            if(File::exists(public_path('upload/'.$result->image_folder))) {
                                $imagesAd = File::files(public_path('upload/'.$result->image_folder)); // this is recursive

                                foreach($imagesAd as $path) {

                                    array_push($imagesArrs,pathinfo($path)['basename']);
                                }
                            }

                            ?>
                                <div class="col-4 table-responsive">
                                    <table class="table " border="1" cellspacing="10" cellpadding="10">
                                        <tbody class="text-center">
                                        <tr>
                                            <th scope="col"><img src="{!! !empty($imagesArrs[0]) ? "/upload/$result->image_folder/$imagesArrs[0]" : '/img/no-pic.png?v=1' !!}" alt="" style="width: 100%;height: 220px"></th>
                                        </tr>
                                        <tr>

                                            <td valign="top" align="left">

                                                    <b>@lang('addAd.ship_type'): {!! empty($result->Type->Name[0]->name) ? $result->Type->FallBackName->name : $result->Type->Name[0]->name !!}</b><br />
                                                    @lang('addAd.pavilion'):    {!! $result->Country->name !!}<br />
                                                    @lang('addAd.weight_passengers'): {!! $result->capacity !!}<br />
                                                    @lang('addAd.ship_navigation'): {!! empty($result->NavigationZone->Name[0]->name) ? $result->NavigationZone->FallbackName->name : $result->NavigationZone->Name[0]->name !!}<br /><b>
                                                    <span class="text-left">   <a href="#" data-toggle="modal" data-target="#modalContact" data-whatever="{!! $result->id !!}">Contact</a> </span>
                                                    @if(!empty($imagesArrs[0]))
                                                        <span class="float-right launcher" style="cursor: pointer" onclick='launch({!! json_encode($imagesArrs) !!},"{!! $result->image_folder !!}")'>@lang('addAd.gallery')</span>  </b></td>
                                                    @endif

                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                        @endforeach
                    @endif

                </div>
                {{ $results->appends(request()->input())->links() }}


        </div>
    </div>
    </div>



    <div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Contact</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="contact-box center-version">


                            <h3 class="m-b-xs "><strong class="name"></strong></h3>
                            <div class="font-bold mail"></div>
                            <address class="m-t-20">
                                <i class="fa fa-envelope"></i>
                                <span class="email"></span><br>
                                <i class="fa fa-phone"></i><span class="phone"></span><br>

                            </address>


                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('customJS')

    <script src="/incs/jquery.multiselect.js"></script>
    <script type="text/javascript" src="/incs/magnific/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="/incs/magnific/magnific-popup.css">

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

         multisel = $('select[multiple].active');
        multisel.multiselect({
                columns: 1,
                placeholder: "@lang('addAd.select')",
                search: true,
                searchOptions: {
                    'default': "@lang('addAd.select')"
                },
                selectAll: true
            });




        function launch(pics,folder){
           var itms = [];
            $.each(pics,function (key,val) {
                itms.push({
                    src: '/upload/'+folder+'/'+val
                })
            })

            $.magnificPopup.open({
                items: itms,
                gallery: {
                    enabled: true
                },
                type: 'image' // this is default type
            });
        }



        @if($errors->has('rivers_sectors'))
            $('#ms-list-1 button').addClass('is-invalid')
        @endif



        $('#modalContact').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


            var modal = $(this)
            $.ajax({
                url: "/getContactDetails",
                type:"POST",
                data: { id: recipient },
                success:function(data){
                  console.log(data)


                    if (data.owner_email){
                        modal.find('.email').text(data.owner_email)
                    }else {
                        modal.find('.email').text(data.owner.email)
                    }
                    modal.find('.name').text(data.owner_name)
                    modal.find('.phone').text(data.phone)
                },error:function(){

                }
            }); //end of ajax


        })


        $('#zona').change(function () {
            val = $(this).val();;

                if (val == 3){
                    multisel.multiselect("disable")
                } else {

                    multisel.multiselect("disable",false)

                }
        })
        @if(!empty($oldReq) && $oldReq->ship_navigation == 3)
            multisel.multiselect("disable")
        @endif
    </script>
@endsection