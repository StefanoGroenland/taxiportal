@extends('layouts.master')

@section('content')       
                <div class="page-content">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-grey-gallery">
                                <i class="fa fa-plus font-grey-gallery"></i>
                                <span class="caption-subject bold uppercase"> Medewerker toevoegen</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-sidebar">
                                        <div class="portlet light profile-sidebar-portlet bordered">
                                            <div class="profile-usertitle">
                                               <form role="form">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 center-block">
                                                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail center-block" style="width: 100%; height: 150px;">
                                                                    <img class="img-responsive" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail center-block" style="max-width: 100%; max-height: 150px;"> </div>
                                                                <div>
                                                                    <span class="btn default btn-file center-block">
                                                                        <span class="fileinput-new">Selecteer profiel foto</span>
                                                                        <span class="fileinput-exists"> Verander </span>
                                                                        <input type="file" name="..."> 
                                                                    </span>
                                                                    <br />
                                                                    <a href="javascript:;" class="btn red-intense fileinput-exists center-block" data-dismiss="fileinput"> Verwijder </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-body">
                                                        <div class="general-item-list">
                                                            <form role="form">
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-icon">
                                                                                    <input type="text" class="form-control" id="voornaam" value="">
                                                                                    <label for="voornaam">Voornaam</label>
                                                                                    <i class="fa fa-user"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
                                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-icon">
                                                                                    <input type="text" class="form-control" id="email" value="">
                                                                                    <label for="email">E-mail</label>
                                                                                    <i class="fa fa-envelope-o"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                   
                                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-icon">
                                                                                    <input type="text" class="form-control" id="telefoonnummer" value="">
                                                                                    <label for="telefoonnummer">Telefoonnummer</label>
                                                                                    <i class="fa fa-phone"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-icon">
                                                                                    <input type="text" class="form-control" id="functie" value="">
                                                                                    <label for="functie">Functie</label>
                                                                                    <i class="fa fa-user"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-icon">
                                                                                    <input type="password" class="form-control" id="wachtwoord" value="">
                                                                                    <label for="wachtwoord">Wachtwoord</label>
                                                                                    <i class="fa fa-lock"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-icon">
                                                                                    <input type="password" class="form-control" id="herhaal_wachtwoord" value="">
                                                                                    <label for="herhaal_wachtwoord">Herhaal wachtwoord</label>
                                                                                    <i class="fa fa-lock"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-actions noborder pull-right">
                                                                                <button type="button" class="btn green-meadow"><i class="fa fa-plus"></i>Toevoegen</button>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection