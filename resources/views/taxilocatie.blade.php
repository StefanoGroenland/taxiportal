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
                                        <div class="table-responsive">
                                            <table class="table table-hover" >
                                                <thead>
                                                    <th><small> Kenteken</small></th>
                                                    <th><i class="fa fa-taxi" ></i><small> Merk</small></th>
                                                    <th><small> Model</small></th>
                                                    <th><small> Kleur</small></th>
                                                    <th><i class="fa fa-user"></i><small> Chauffeur</small></th>
                                                    <th><i class="fa fa-wifi" ></i><small> Laatste gezien</small></th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>78-LR-VV</strong></td>
                                                        <td>Opel</td>
                                                        <td>Corsa</td>
                                                        <td>Blauwgrijs</td>
                                                        <td>Stefan Groenland</td>
                                                        <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>XX-XX-XX</strong></td>
                                                        <td>Peugot</td>
                                                        <td>3008</td>
                                                        <td>Zwart</td>
                                                        <td>Richard Perdaan</td>
                                                        <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>XX-XX-XX</strong></td>
                                                        <td>Audi</td>
                                                        <td>A8</td>
                                                        <td>Zwart</td>
                                                        <td>Edward Belgraver</td>
                                                        <td><i class="fa fa-circle" style="color: #f82200;" ></i> <small>15:19 18-02-2016</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>XX-XX-XX</strong></td>
                                                        <td>Audi</td>
                                                        <td>A4</td>
                                                        <td>Zwart</td>
                                                        <td>Martijn de Ridder</td>
                                                        <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>XX-XX-XX</strong></td>
                                                        <td>Toyota</td>
                                                        <td>Starlet</td>
                                                        <td>Groen</td>
                                                        <td>Mace muilman</td>
                                                        <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>XX-XX-XX</strong></td>
                                                        <td>Volkswagen</td>
                                                        <td>Golf</td>
                                                        <td>Blauw</td>
                                                        <td>Kars Hoving</td>
                                                        <td><i class="fa fa-circle" style="color: #f82200;" ></i> <small>15:19 18-02-2016</small></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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