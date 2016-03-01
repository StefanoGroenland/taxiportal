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
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 "> 
                                                    <div id="map" style="height: 400px; width: 100%;" class="contact_maps"></div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group form-md-line-input ">
                                                    	<div class="input-icon">
                                                            <select class="form-control" id="taxi">
                                                                <option value=""></option>
                                                                <option value="1">Kenteken chauffeur</option>
                                                                <option value="2">Kenteken chauffeur</option>
                                                                <option value="3">Kenteken chauffeur</option>
                                                                <option value="4">Kenteken chauffeur</option>
                                                            </select>
                                                            <label for="taxi">Taxi</label>
                                                        	<i class="fa fa-car"></i>
                                                       	</div>
                                           			</div>
                                				</div>
                                				 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="pickup_time" name="pickup_time" value="">
                                                            <label for="start_tijd">Ophaal tijd</label>
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
                                                            <input type="text" class="form-control" id="start_street" name="start_street" value="">
                                                            <label for="start_straat">Straat</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_number" name="start_number" value="">
                                                            <label for="start_huisnummer">Huisnummer</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_zip" name="start_zip" value="">
                                                            <label for="start_postcode">Postcode</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_straat" name="start_city" value="">
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
                                                            <input type="text" class="form-control" id="end_street" name="end_street" value="">
                                                            <label for="eind_straat">Straat</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="end_number" name="end_number" value="">
                                                            <label for="eind_huisnummer">Huisnummer</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="end_zip" name="end_zip" value="">
                                                            <label for="eind_postcode">Postcode</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="end_city" name="end_city" value="">
                                                            <label for="eind_plaats">Plaats</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>

                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="phone_customer" name="phone_customer" value="">
                                                            <label for="eind_plaats">Telefoonnummer klant</label>
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="email_customer" name="email_customer" value="">
                                                            <label for="eind_plaats">Email klant</label>
                                                            <i class="fa fa-envelope-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-actions noborder pull-right">
                                                       <button type="submit" class="btn green-meadow"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
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