@extends('layouts.master')


@section('content')
	<div class="page-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/taxioverzicht">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Aantal taxi's</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-yellow-lemon fa fa-taxi"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Nu actief</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countCars}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/ritten">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Aantal ritten</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green-seagreen fa fa-map-marker"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Vandaag ingepland</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$routeCount}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/ritten/openstaand">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Openstaande ritten</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue fa fa-calendar-plus-o"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Nog te koppelen</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countOpenRoutes}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/opmerkingen">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Opmerkingen</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green-turquoise fa fa-comments-o"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Actie vereist op</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countComments}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <div id="map" style="height: 500px; width: 100%;" class="contact_maps"></div>
                    </div>
                    </div>
                </div>    
                
@endsection

@section('scripts')
	    <script src="{{URL::asset('../assets/js/jquery.waypoints.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.counterup.min.js')}}" type="text/javascript"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyBuzlPSNhmRIEhIl-3ZUidj3fwXfsDSw&amp;sensor=false"></script>
         <script type="text/javascript">

                    jQuery(function($) {
            // Asynchronously Load the map API
            var script = document.createElement('script');
            script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
            document.body.appendChild(script);
        });

        function initialize() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap'
            };

            // Display a map on the page
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            map.setTilt(45);

            // Multiple Markers
            var markers = [
                // ['London Eye, London', 51.503454,-0.119562],
                // ['Palace of Westminster, London', 51.499633,-0.124755]
                @foreach($cars as $taxi)
                    ['',{{$taxi->last_latitude .','. $taxi->last_longtitude}}],
                @endforeach
            ];

            // Info Window Content
            var infoWindowContent = [

                @foreach ($cars as $taxi)
                    ['<div class="info_content">' +
                    '<p><i class="fa fa-taxi"></i> '+ '{{$taxi->license_plate }}' +'</p>' +
                    '<p><i class="fa fa-user"></i> '+ '@if($taxi->driver && $taxi->driver->user){{$taxi->driver->user->firstname}}'+' '+'{{$taxi->driver->user->lastname}}@else Geen chauffeur @endif' +'</p>' +
                    '<p><i class="fa fa-clock-o"></i> '+ '@if($taxi->last_seen != "0000-00-00 00:00:00") {{date("d-m-Y H:i",strtotime($taxi->last_seen))}} @else geen @endif' +'</p>' +
                    '</div>'],
                @endforeach

            ];

            // Display multiple markers on a map
            var infoWindow = new google.maps.InfoWindow(), marker, i;

            // Loop through our array of markers & place each one on the map
            for( i = 0; i < markers.length; i++ ) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i][0]
                });

                // Allow each marker to have an info window
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(infoWindowContent[i][0]);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
            }

            // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(7);
                this.setCenter(new google.maps.LatLng(52.1396726,5.6019347));
                google.maps.event.removeListener(boundsListener);
            });

        }

                </script>


@endsection

