@extends('layouts.master')

@section('content')
<div class="page-content">
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
                                    <form role="form">
                                        <div class="form-body">
                                        	<div class="row">
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
                                				 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_tijd" value="">
                                                            <label for="start_tijd">Ophaal tijd</label>
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
												</div>
                                           </div>
                                            <div class="row">
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<h4>Begin:</h4>
												</div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_straat" value="">
                                                            <label for="start_straat">Straat</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_huisnummer" value="">
                                                            <label for="start_huisnummer">Huisnummer</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_postcode" value="">
                                                            <label for="start_postcode">Postcode</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="start_plaats" value="">
                                                            <label for="start_plaats">Plaats</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                           </div>
                                           <div class="row">
                                          		<div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<h4>Eind:</h4>
												</div>
                                           		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="eind_straat" value="">
                                                            <label for="eind_straat">Straat</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="eind_huisnummer" value="">
                                                            <label for="eind_huisnummer">Huisnummer</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="eind_postcode" value="">
                                                            <label for="eind_postcode">Postcode</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="eind_plaats" value="">
                                                            <label for="eind_plaats">Plaats</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                           </div>
                                           
                                           <div class="row">
                                				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="voornaam" value="">
                                                            <label for="voornaam">Voornaam</label>
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="tussenvoegsel" value="">
                                                            <label for="tussenvoegsel">Tussenvoegsel</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="achternaam" value="">
                                                            <label for="achternaam">Achternaam</label>
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
												</div>
                                           </div>
                                           <div class="row">
												<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group form-md-line-input ">
                                                    	<div class="input-icon">
                                                            <select class="form-control" id="geslacht">
                                                                <option value=""></option>
                                                                <option value="1">Man</option>
                                                                <option value="2">Vrouw</option>
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

@endsection
