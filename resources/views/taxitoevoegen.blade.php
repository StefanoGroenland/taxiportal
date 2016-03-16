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
                                        <span class="caption-subject bold uppercase"> Taxi toevoegen</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form method="POST" class="formulier" onsubmit="return checkCoords();" action="/addTaxi">
                                        {!! csrf_field() !!}
                                        <div class="form-body">
                                        	<div class="row">
                                				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="license_plate" name="license_plate" data-validate="required" value="{{old('license_plate')}}">
                                                            <label for="kenteken">Kenteken</label>
                                                            <i class="fa fa-hashtag"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_brand" name="car_brand" data-validate="required" value="{{old('car_brand')}}">
                                                            <label for="merk">Merk</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>

                                           		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_color" name="car_model" data-validate="required" value="{{old('car_model')}}">
                                                            <label for="model">Model</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_model" name="car_color" data-validate="required" value="{{old('car_color')}}">
                                                            <label for="kleur">Kleur</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                				<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                					<div class="form-group form-md-line-input ">
                                                    	<div class="input-icon">
                                                            <select class="form-control" id="driver" name="driver" data-validate="required" value="{{old('driver')}}">
                                                                <option>Niet koppelen</option>
                                                                @if($driverCount > 0)
                                                                    @foreach($drivers as $driver)
                                                                    @if($driver->user)
                                                                        <option value="{{$driver->id}}">{{ $driver->user->firstname .' '. $driver->user->lastname}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                @else
                                                                    <option>Geen chauffeur koppelbaar</option>
                                                                @endif
                                                            </select>
                                                            <label for="chauffeur">Chauffeur</label>
                                                        	<i class="fa fa-user"></i>
                                                       	</div>
                                           			</div>
                                				</div>
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-actions noborder pull-right ">
                                                    <a type="button" href="/taxioverzicht" class="btn default">Annuleren</a>
                                                    <button type="submit" class="btn green-meadow sendButton"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
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
    <script>
        $(function() {
            $('form').jvalidate({ 
                errorMessage: true
            });
        });
    </script>
@endsection
