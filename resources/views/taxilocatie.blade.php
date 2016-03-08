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
                                    <div id="map" style="height: 500px; width: 100%;" class="contact_maps md-shadow-z-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@include('layouts.car-location-maps')