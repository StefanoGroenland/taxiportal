@extends('layouts.master')

@section('content')
	<div class="page-content">
        @if (count($errors))
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                 @endforeach
            </ul>
        @endif
        <div class="row">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-cog font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Wijzig rit</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" action="/editRoute/{{$id}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 "> 
                                        <div id="map" style="height: 400px; width: 100%;" class="contact_maps"></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <select class="form-control" id="taxi" name='taxi'>
                                                    <option>Niet koppelen</option>
                                                    @if($routes->taxi)
                                                        <option value="{{$routes->taxi->id}}" @if($routes->taxi->driver_id != "0")selected @endif>{{ $routes->taxi->license_plate .' - '. $routes->taxi->car_brand .' - '. $routes->taxi->car_model .' - '. $routes->taxi->car_color}}</option>
                                                    @endif
                                                    @if($carCount > 0)
                                                        @foreach($cars as $car)
                                                            <option value="{{$car->id}}">{{ $car->license_plate .' - '. $car->car_brand .' - '. $car->car_model .' - '. $car->car_color}}</option>
                                                        @endforeach
                                                    @else
                                                        <option>Geen auto's koppelbaar</option>
                                                    @endif
                                                </select>
                                                <label for="taxi">Taxi</label>
                                                <i class="fa fa-car"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input data-toggle="tooltip" title="Ophaal tijd" type="text" name="pickup_time" class="form_datetime form-control date-picker"  value="@if(old('pickup_time')){{old('pickup_time')}}@else{{date('d-m-Y H:i',strtotime($routes->pickup_time))}}@endif" data-rule-maxlength="30">
                                                <label for="pickup_time">Ophaal tijd</label>
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                        <h4>Begin:</h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="start_street" name="start_street" value="@if(old('start_street')){{old('start_street')}}@else{{$routes->start_street}}@endif">
                                                <label for="start_straat">Straat</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="start_number" name="start_number" value="@if(old('start_number')){{old('start_number')}}@else{{$routes->start_number}}@endif">
                                                <label for="start_huisnummer">Huisnummer</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="start_zip" name="start_zip" value="@if(old('start_zip')){{old('start_zip')}}@else{{$routes->start_zip}}@endif">
                                                <label for="start_postcode">Postcode</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="start_straat" name="start_city" value="@if(old('start_city')){{old('start_city')}}@else{{$routes->start_city}}@endif">
                                                <label for="start_plaats">Plaats</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                        <h4>Eind:</h4>
                                    </div>
                                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="end_street" name="end_street" value="@if(old('end_street')){{old('end_street')}}@else{{$routes->end_street}}@endif">
                                                <label for="eind_straat">Straat</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="end_number" name="end_number" value="@if(old('end_number')){{old('end_number')}}@else{{$routes->end_number}}@endif">
                                                <label for="eind_huisnummer">Huisnummer</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="end_zip" name="end_zip" value="@if(old('end_zip')){{old('end_zip')}}@else{{$routes->end_zip}}@endif">
                                                <label for="eind_postcode">Postcode</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="end_city" name="end_city" value="@if(old('end_city')){{old('end_city')}}@else{{$routes->end_city}}@endif">
                                                <label for="eind_plaats">Plaats</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="phone_customer" name="phone_customer" value="@if(old('end_phone_customercity')){{old('phone_customer')}}@else{{$routes->phone_customer}}@endif">
                                                <label for="eind_plaats">Telefoonnummer klant</label>
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="email_customer" name="email_customer" value="@if(old('email_customer')){{old('email_customer')}}@else{{$routes->email_customer}}@endif">
                                                <label for="eind_plaats">Email klant</label>
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-actions noborder pull-right">
                                            <button type="submit" class="btn green-meadow"><i class="fa fa-check" aria-hidden="true"></i>Opslaan</button>
                                            <a type="button" href="/ritten" class="btn default">Annuleren</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>

@endsection
@section('scripts')
<script src="{{URL::asset('../assets/js/jvalidate.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('../assets/js/locale/messages.nl.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyBuzlPSNhmRIEhIl-3ZUidj3fwXfsDSw&amp;sensor=false"></script>

<script type="text/javascript" src="{{URL::asset('../assets/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{URL::asset('../assets/js/locale/bootstrap-datetimepicker.nl.js')}}" charset="UTF-8"></script>

    <script type="text/javascript"> 
    $(function() {
        $('form').jvalidate({ 
            errorMessage: true
        });
    });
    var myLatlng = new google.maps.LatLng(51.929759,4.471919);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: new google.maps.LatLng(51.9996726,5.5019347),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: true 
    });  

    
    $(document).ready(function() {
           $(".form_datetime").datetimepicker({
           language: 'nl',
           weekStart: 1,
           format: 'dd-mm-yyyy hh:ii',
           autoclose: true
           });
    });

    </script>
@endsection
