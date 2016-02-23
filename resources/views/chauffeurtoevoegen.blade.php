@extends('layouts.master')

@section('content')
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-grey-gallery">
                                        <i class="fa fa-plus font-grey-gallery"></i>
                                        <span class="caption-subject bold uppercase"> Chauffeur toevoegen</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form role="form">
                                        <div class="form-body">
                                            <div class="row">
                                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="email" value="">
                                                            <label for="email">E-mail</label>
                                                            <i class="fa fa-envelope-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="telefoonnummer" value="">
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
                                                            <input type="password" class="form-control" id="huidig_wachtwoord" value="">
                                                            <label for="huidig_wachtwoord">Huidig wachtwoord</label>
                                                            <i class="fa fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="password" class="form-control" id="nieuw_wachtwoord" value="">
                                                            <label for="nieuw_wachtwoord">Nieuw wachtwoord</label>
                                                            <i class="fa fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="password" class="form-control" id="herhaal_nieuw_wachtwoord" value="">
                                                            <label for="herhaal_nieuw_wachtwoord">Herhaal nieuw wachtwoord</label>
                                                            <i class="fa fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="voornaam" value="">
                                                            <label for="voornaam">Voornaam</label>
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="tussenvoegsel" value="">
                                                            <label for="tussenvoegsel">Tussenvoegsel</label>
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="achternaam" value="">
                                                            <label for="achternaam">Achternaam</label>
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group form-md-line-input ">
                                                        <div class="input-icon">
                                                            <select class="form-control" id="geslacht">
                                                                <option value=""></option>
                                                                <option value="man">Man</option>
                                                                <option value="vrouw">Vrouw</option>
                                                            </select>
                                                            <label for="geslacht">Geslacht</label>
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-actions noborder pull-right">
                                                    <button type="button" class="btn green-meadow"><i class="fa fa-plus" ></i>Toevoegen</button>
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