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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyBuzlPSNhmRIEhIl-3ZUidj3fwXfsDSw&amp;sensor=false"></script>
        <script type="text/javascript"> 
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
        </script>
@endsection