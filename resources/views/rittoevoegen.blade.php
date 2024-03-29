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
                                        <i class="fa fa-plus font-grey-gallery"></i>
                                        <span class="caption-subject bold uppercase"> Rit toevoegen</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                   <form role="form" method="POST" action="/addRoute">
                                        {!! csrf_field() !!}
                                        <div class="form-body">
                                             <div class="row">
                                    <div class="col-lg-2 col-md-12"></div>
                                    <div class="col-lg-8 col-md-12"> 
                                        <div id="map" style="height: 400px; width: 100%;" class="contact_maps"></div>
                                    </div>
                                    <div style="width:100%; height:10%" id="distance_road"></div>
                                    <div style="width:100%; height:10%" id="time"></div>

                                    <input type="hidden" class="distance_road" name="distance_road"></input>
                                    <input type="hidden" class="time" name="time"></input>

                                    <div class="col-lg-2 col-md-12"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <select class="form-control" id="taxi" name='taxi'>
                                                    <option>Niet koppelen</option>
                                                    @if($carCount > 0)
                                                        @foreach($cars as $car)
                                                            <option  value="{{$car->id}}" >{{ $car->license_plate .' - '. $car->car_brand .' - '. $car->car_model .' - '. $car->car_color}}</option>
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
                                     <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input data-toggle="tooltip" title="Ophaal tijd" type="text" name="pickup_time" class="form_datetime form-control date-picker"  value="@if(old('pickup_time')){{old('pickup_time')}}@endif" data-rule-maxlength="30">
                                                <label for="start_tijd">Ophaal tijd</label>
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <h4>Begin positie:</h4>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="start_street" placeholder="" data-geo="route" name="start_street" data-validate="required" value="{{old('start_street')}}">
                                                        <label for="start_straat">Straat</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
     										</div>
                                             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="start_number" data-geo="street_number" name="start_number" data-validate="required" value="{{old('start_number')}}">
                                                        <label for="start_postcode">Huisnummer</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="start_zip" data-geo="postal_code" name="start_zip" data-validate="required" value="{{old('start_zip')}}">
                                                        <label for="start_postcode">Postcode</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="start_city" data-geo="locality" name="start_city" data-validate="required" value="{{old('start_city')}}">
                                                        <label for="start_postcode">Plaats</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <h4>Eind positie:</h4>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="end_street" placeholder="" data-geo-end="route"  name="end_street" data-validate="required" value="{{old('end_street')}}">
                                                        <label for="start_straat">Straat</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="end_number" data-geo-end="street_number"  name="end_number" data-validate="required" value="{{old('end_number')}}">
                                                        <label for="start_postcode">Huisnummer</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="end_zip" data-geo-end="postal_code" name="end_zip" data-validate="required" value="{{old('end_zip')}}">
                                                        <label for="start_postcode">Postcode</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" id="end_city" data-geo-end="locality" name="end_city" data-validate="required" value="{{old('end_city')}}">
                                                        <label for="start_postcode">Plaats</label>
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="phone_customer" name="phone_customer" data-validate="required|number|minlength:10|maxlength:10" value="{{old('phone_customer')}}">
                                                <label for="eind_plaats">Telefoonnummer klant</label>
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="email_customer" name="email_customer" data-validate="required|email" value="{{old('email_customer')}}">
                                                <label for="eind_plaats">Email klant</label>
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="" id="end_all">
                               </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-actions noborder pull-right">
                                            <a type="button" href="/ritten" class="btn default">Annuleren</a>
                                            <button type="submit" class="btn green-meadow"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
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

<script type="text/javascript" src="{{URL::asset('../assets/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{URL::asset('../assets/js/locale/bootstrap-datetimepicker.nl.js')}}" charset="UTF-8"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyBuzlPSNhmRIEhIl-3ZUidj3fwXfsDSw&amp;sensor=false&libraries=places"></script>
<script type="text/javascript" src="{{URL::asset('/assets/js/jquery.geocomplete.min.js')}}"></script>


<script type="text/javascript"> 
// Geocomplete google maps
     $(function(){
        $("#start_street").geocomplete({
          details: "form",
          detailsAttribute: "data-geo",
          types: ["geocode", "establishment"],
        });


      });
      $(function(){
        $("#end_street").geocomplete({
          details: "form",
          detailsAttribute: 'data-geo-end',
          types: ["geocode", "establishment"],
        });

      });
// end geocomplete google maps
    $(function() {
        $('form').jvalidate({ 
            errorMessage: true
        });
    });
       
    $(document).ready(function() {
           $(".form_datetime").datetimepicker({
           language: 'nl',
           weekStart: 1,
           format: 'dd-mm-yyyy hh:ii',
           autoclose: true
           });
    });

    //maps
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: {lat: 52.1996726, lng: 5.4019347},
            styles: [{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"on"}]}]
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
       

        $('#end_street, #end_number, #end_zip, #end_city').on('blur', function() {
            onChangeHandler();
        });
    }
    
    initMap();

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
         if ($('#start_street').val().length > 0 && $('#start_number').val().length > 0 && $('#start_zip').val().length > 0 && $('#start_city').val().length > 0) {
            var startstreet = $('#start_street').val();
            var startnumber    = $('#start_number').val();
            var startzip    = $('#start_zip').val();
            var startcity    = $('#start_city').val();
        } 
        if ($('#end_street').val().length > 0 && $('#end_number').val().length > 0 && $('#end_zip').val().length > 0 && $('#end_city').val().length > 0) {
            var endstreet = $('#end_street').val();
            var endnumber    = $('#end_number').val();
            var endzip    = $('#end_zip').val();
            var endcity    = $('#end_city').val();
        } 
        var endall = endstreet + ' ' + endnumber + ' ' + endzip + ' ' + endcity;
        var startall = startstreet + ' ' + startnumber + ' ' + startzip + ' ' + startcity;
	
      directionsService.route({
        origin: startall,
        destination: endall,
        travelMode: google.maps.TravelMode.DRIVING,

      }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        }
      });
         
     
    
        // The distance and the time form google
            var geocoder = new google.maps.Geocoder(); // creating a new geocode object
            geocoder.geocode( { 'address': startall}, function(results, status){
                if (status == google.maps.GeocoderStatus.OK){
                    //location of first address (latitude + longitude)
                    location1 = results[0].geometry.location;
                }
            });
            geocoder.geocode( { 'address': endall}, function(results, status){
                if (status == google.maps.GeocoderStatus.OK){
                    //location of second address (latitude + longitude)
                    location2 = results[0].geometry.location;
                    // calling the showMap() function to create and show the map 
                    showMap();
                } 
            });
    }
    var location1;
    var location2;
    var address1;
    var address2;
    var geocoder;
    var map;
    var distance;
    var time;
    // creates and shows the map
    function showMap(){
        // show route between the points
        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true,
            suppressInfoWindows: true
        });
        directionsDisplay.setMap(map);
        var request = {
            origin:location1, 
            destination:location2,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status){ 
            if (status == google.maps.DirectionsStatus.OK){

                directionsDisplay.setDirections(response);
                distance = "Afstand: "+response.routes[0].legs[0].distance.text;
                time = "Tijd: "+response.routes[0].legs[0].duration.text;
                document.getElementById("time").innerHTML = time;
                document.getElementById("distance_road").innerHTML = distance;
                var afstand = response.routes[0].legs[0].distance.text;
                var tijd = response.routes[0].legs[0].duration.text;
                $('.time').val(tijd);
                $('.distance_road').val(afstand);
                
            }
        });

    }
</script>
@endsection