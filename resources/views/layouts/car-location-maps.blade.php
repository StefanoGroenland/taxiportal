 @section('scripts')
        <script src="{{URL::asset('../assets/js/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script>
    @if(Auth::user()->user_rank == 'admin')
        jQuery(function($) {
             // Asynchronously Load the map API
             var script = document.createElement('script');
             script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
             document.body.appendChild(script);
         });

            var map;
            var markers = []; // Create a marker array to hold your markers
            var cars = [
                @foreach($cars as $taxi)
                    @foreach($taxi->emergency as $taxi->emergency)
                        @if($taxi->emergency)
                        ['',{{$taxi->last_latitude .','. $taxi->last_longtitude .','. $taxi->emergency->id .','. $taxi->emergency->seen }}],
                        @endif
                    @endforeach
                        ['',{{$taxi->last_latitude .','. $taxi->last_longtitude}}],
                @endforeach
            ];
            var bases = [
                @foreach($bases as $base)
                    ['',{{$base->latitude .','. $base->longtitude}}],
                @endforeach
            ];
            
            
            
            function reloadMarkers() {
                // Loop through markers and set map to null for each
                for (var i=0; i<markers.length; i++) {
                    markers[i].setMap(null);
                }
                
                // Reset the markers/cars array
                markers = [];
                cars    = [];
                var i   = 0;
                var x   = 0;

                $.post('http://taxiportaal.dev/api/v1/locations', {key:'alpha'}, function(data){
                    $.each(data.cars, function(key, value) {
                        cars[i] = ['', value['last_latitude'], value['last_longtitude'], value.emergency[0]['id'], value.emergency[0]['seen']];
                        i++;
                    });

                    setMarkers(cars);
                });

                $.post('http://taxiportaal.dev/api/v1/locations/bases', {key:'alpha'}, function(data){

                    $.each(data.bases, function(key, value) {
                        bases[x] = ['', value['latitude'], value['longtitude']];
                        x++;
                    });

                    setBaseMarkers(bases);
                });
            }

            window.setInterval(function(){
              reloadMarkers();
            }, 300000);

            function setBaseMarkers(locations) {
                for (var i = 0; i < locations.length; i++) {
                    var bases = locations[i];
                    var myLatLng = new google.maps.LatLng(bases[1], bases[2]);
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        icon: 'https://cdn3.iconfinder.com/data/icons/mapicons/icons/home.png',
                        map: map,
                        zIndex: bases[3]
                    });
                    // Push marker to markers array
                    markers.push(marker);
                }
            }
            
            function setMarkers(locations) {
                for (var i = 0; i < locations.length; i++) {
                    if(locations[i][4] < 1 && locations[i][3] > 0){
                        var cars = locations[i];
                        var myLatLng = new google.maps.LatLng(cars[1], cars[2]);
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            icon: 'https://cdn3.iconfinder.com/data/icons/mapicons/icons/firstaid.png',
                            map: map,
                            zIndex: cars[5]
                        });
                        // Push marker to markers array
                    }else{
                        var cars = locations[i];
                        var myLatLng = new google.maps.LatLng(cars[1], cars[2]);
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            icon: 'https://cdn3.iconfinder.com/data/icons/mapicons/icons/taxi.png',
                            map: map,
                            zIndex: cars[5]
                        });
                        // Push marker to markers array

                    }
                     markers.push(marker);
                }
            }

            function initialize() {
                var mapOptions = {
                    zoom: 7,
                    center: new google.maps.LatLng( 52.1396726,5.6019347),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                
                map = new google.maps.Map(document.getElementById('map'), mapOptions);
                setMarkers(cars);
                setBaseMarkers(bases);

                // Bind event listener on button to reload markers
//                document.getElementById('reloadMarkers').addEventListener('click', reloadMarkers);
            }
//            initialize();
            </script>
        @endif
 @endsection
