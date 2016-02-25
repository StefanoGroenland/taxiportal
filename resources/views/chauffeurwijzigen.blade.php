@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-cog font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Wijzig chauffeur</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" action="/editDriver/{{$id}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="email" name="email" value="{{$driver->user->email}}">
                                                <label for="email">E-mail</label>
                                                <i class="fa fa-envelope-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="telefoonnummer" name="phonenumber" value="{{$driver->user->phone_number}}">
                                                <label for="telefoonnummer">Telefoonnummer</label>
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="voornaam" name="firstname" value="{{$driver->user->firstname}}">
                                                <label for="voornaam">Voornaam</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="tussenvoegsel" name="surname" value="{{$driver->user->surname}}">
                                                <label for="tussenvoegsel">Tussenvoegsel</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="achternaam" name="lastname" value="{{$driver->user->lastname}}">
                                                <label for="achternaam">Achternaam</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="password" class="form-control" id="nieuw_wachtwoord" name="new_password">
                                                <label for="nieuw_wachtwoord">Nieuw wachtwoord</label>
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="password" class="form-control" id="herhaal_nieuw_wachtwoord" name="repeat_password">
                                                <label for="herhaal_nieuw_wachtwoord">Herhaal nieuw wachtwoord</label>
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <select class="form-control" id="geslacht" name="sex">
                                                    <option @if($driver->user->geslacht == 'man')selected @endif value="man">Man</option>
                                                    <option @if($driver->user->geslacht == 'vrouw')selected @endif value="vrouw">Vrouw</option>
                                                </select>
                                                <label for="geslacht">Geslacht</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <input type="number" class="form-control" id="driver_exp" name="driver_exp" value="{{$driver->drivers_exp}}">
                                                <label for="driver_exp">Rijervaring (jaren)</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <textarea class="form-control" id="global_information" name="global_information"/>{{$driver->global_information}}</textarea>
                                                <label for="global_information">Informatie</label>
                                                <i class="fa fa-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <select class="form-control" id="car" name="car">
                                                    <option>Niet koppelen</option>
                                                    <option value="{{$driver->taxi->id}}" @if($driver->taxi->driver_id != "0")selected @endif>{{ $driver->taxi->license_plate .' - '. $driver->taxi->car_brand .' - '. $driver->taxi->car_model .' - '. $driver->taxi->car_color}}</option>
                                                    @if($carCount > 0)
                                                        @foreach($cars as $car)
                                                            <option value="{{$car->id}}">{{ $car->license_plate .' - '. $car->car_brand .' - '. $car->car_model .' - '. $car->car_color}}</option>  
                                                        @endforeach
                                                    @else
                                                        <option>Geen auto's koppelbaar</option>
                                                    @endif
                                                </select>
                                                <label for="car">Informatie</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-actions noborder pull-right">
                                            <button type="submit" class="btn green-meadow"><i class="fa fa-check" aria-hidden="true"></i>Opslaan</button>
                                            <button type="button" class="btn default">Annuleren</button>
                                        </div>
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