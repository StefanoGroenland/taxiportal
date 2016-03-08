 @section('scripts')
 	    <script src="{{URL::asset('../assets/js/jquery.waypoints.min.js')}}" type="text/javascript"></script>
 	    <script src="{{URL::asset('../assets/js/jquery.counterup.min.js')}}" type="text/javascript"></script>
        @if(Auth::user()->user_rank == 'admin')
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

            var invisible = [
                ['', 52.1396726,5.6019347],
            ]

             // Multiple Markers
             var markers = [
                 // ['London Eye, London', 51.503454,-0.119562],

                 @foreach($cars as $taxi)
                     ['',{{$taxi->last_latitude .','. $taxi->last_longtitude}}],
                 @endforeach
             ];

             var bases = [
                 @foreach($bases as $base)
                     ['',{{$base->latitude .','. $base->longtitude}}],
                 @endforeach
             ];

            var infoContent = [
                @foreach ($bases as $base)
                    ['<div class="info_content">' +
                    '<p><i class="fa fa-building"></i> '+ '{{$base->base_name }}' +'</p>' +
                    '</div>'],
                @endforeach
            ];

            var infoWindowContentz = [

                ['<div class="info_content">' +
                '<p><i class="fa fa-building"></i> '+ '' +'</p>' +
                '</div>'],
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
             {{-- */$x = 0;/* --}}

             @foreach($bases as $base)
                 var position = new google.maps.LatLng(bases['{{$x}}'][1], bases['{{$x}}'][2]);
                 bounds.extend(position);
                 marker = new google.maps.Marker({
                     position: position,
                     map: map,
                     icon: 'https://cdn3.iconfinder.com/data/icons/mapicons/icons/home.png',
                     title: bases['{{$x}}'][0]
                 });
                  // Allow each marker to have an info window
                 google.maps.event.addListener(marker, 'click', (function(marker, i) {
                     return function() {
                         infoWindow.setContent(infoContent['{{$x}}'][0]);
                         infoWindow.open(map, marker);
                     }
                 })(marker, '{{$x}}'));

                 // Automatically center the map fitting all markers on the screen
                 {{-- */$x++;/* --}}
             @endforeach



             // Loop through our array of markers & place each one on the map
             {{-- */$i = 0;/* --}}
             @foreach($cars as $taxi)

                 var position = new google.maps.LatLng(markers['{{$i}}'][1], markers['{{$i}}'][2]);
                 bounds.extend(position);
                 marker = new google.maps.Marker({
                     position: position,
                     map: map,
                     icon: 'https://cdn3.iconfinder.com/data/icons/mapicons/icons/taxi.png',



                     @if($taxi->emergency)
                         @foreach($taxi->emergency as $sos)
                             @if($sos->taxi_id == $taxi->id && $sos->seen == 0)
                                 icon: 'https://cdn3.iconfinder.com/data/icons/mapicons/icons/firstaid.png',
                             @endif
                         @endforeach
                     @endif
                     title: markers['{{$i}}'][0]
                 });
                  // Allow each marker to have an info window
                 google.maps.event.addListener(marker, 'click', (function(marker, i) {
                     return function() {
                         infoWindow.setContent(infoWindowContent['{{$i}}'][0]);
                         infoWindow.open(map, marker);
                     }
                 })(marker, '{{$i}}'));

                 // Automatically center the map fitting all markers on the screen
                 map.fitBounds(bounds);
                 {{-- */$i++;/* --}}
             @endforeach
            for( i = 0; i < invisible.length; i++ ) {
                            var position = new google.maps.LatLng(invisible[i][1], invisible[i][2]);
                            bounds.extend(position);
                            marker = new google.maps.Marker({
                                position: position,
                                map: map,
                                title: markers[i][0]
                            });
                    marker.setVisible(false);
                            // Allow each marker to have an info window
                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function() {
                                    infoWindow.setContent(infoWindowContentz[i][0]);
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
        @endif
 @endsection