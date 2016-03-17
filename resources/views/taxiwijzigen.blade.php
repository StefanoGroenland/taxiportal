@extends('layouts.master')

@section('content')
<div class="page-content">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-grey-gallery">
                                        <i class="icon-settings font-grey-gallery"></i>
                                        <span class="caption-subject bold uppercase"> Wijzig taxi</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form role="form" method="POST" action="/editTaxi/{{$id}}">
                                    {!! csrf_field() !!}
                                        <div class="form-body">
                                        	<div class="row">
                                				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="plate-form">
                                                            <span class="eu"></span>
                                                            <input type="text" class="kenteken_input" id="license_plate" name="license_plate" data-validate="required" value="{{old('license_plate')}}">
                                                        </div>       
                                                    </div>
												</div>
                                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_brand" name="car_brand" data-validate="required" value="@if(old('car_brand')){{old('car_brand')}}@else{{$taxi->car_brand}}@endif">
                                                            <label for="merk">Merk</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                           		<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_model" name="car_model" data-validate="required" value="@if(old('car_model')){{old('car_model')}}@else{{$taxi->car_model}}@endif">
                                                            <label for="model">Model</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_color" name="car_color" data-validate="required" value="@if(old('car_color')){{old('car_color')}}@else{{$taxi->car_color}}@endif">
                                                            <label for="kleur">Kleur</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                				<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group form-md-line-input ">
                                                        <div class="input-icon">
                                                            <select class="form-control" id="driver" name="driver" data-validate="required">
                                                                <option>Niet koppelen</option>
                                                               
                                                                @if($driverCount > 0)
                                                                    @foreach($drivers as $driver)
                                                                        @if($driver->user && $user && $user->driver)
                                                                            <option @if($user->driver->id == $driver->id) selected @endif value="{{$driver->id}}">{{ $driver->user->firstname .' '. $driver->user->lastname}}</option>
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
                                                    <button type="submit" class="btn green-meadow"><i class="fa fa-check" aria-hidden="true"></i>Opslaan</button>
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
