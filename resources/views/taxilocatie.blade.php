@extends('layouts.master')

@section('content')
	<div class="page-content"> 
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-grey-gallery">
                                <i class="fa fa-map-marker font-grey-gallery"></i>
                                <span class="caption-subject bold uppercase">Taxi's</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                           <div class="row">
                                <div class="col-lg-6"> 
                                   <div class="portlet-body form">
                                        @include('layouts.tables.taxi-location-table')
                                    </div>
                                </div>
                                <div class="col-lg-6 "> 
                                    <div id="map" style="height: 500px; width: 100%;" class="contact_maps"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('scripts')
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