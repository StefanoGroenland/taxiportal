@extends('layouts.master')


@section('content')
<div class="page-content">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-grey-gallery">
                                        <i class="icon-settings font-grey-gallery"></i>
                                        <span class="caption-subject bold uppercase"> Wijzig chauffeur</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form role="form">
                                        <div class="form-body">
                                        	<div class="row">
                                				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label for="bedrijfsnaam">E-mail</label>
														<input type="text" class="form-control no-border-radius" name="email" placeholder="Email" value="richard@moodles.nl">
													</div>
												</div>
                                                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group has-info">
                                                        <label for="form_control_1">Telefoonnummer</label>
                                                        <input type="text" class="form-control no-border-radius" required="true" maxlength="10" name="telefoonnummer" value="1234567890">
                                                    </div>
                                                </div>
                                           </div>
                                            <div class="row">
                                				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group has-info">
                                                		<label for="form_control_1">Huidig wachtwoord</label>
                                                		<input type="password" class="form-control no-border-radius" id="form_control_1" placeholder="x" value="gfbvcvcvbgfc">
                                                		
                                            		</div>
                                            	</div>	
                                            	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group has-info">
                                                		<label for="form_control_1">Nieuw wachtwoord</label>
                                                		<input type="password" class="form-control no-border-radius" id="form_control_1" placeholder="x" value="gfbvcvcvbgfc">
                                                		
                                            		</div>
                                				</div>
                                				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group has-info">
                                                		<label for="form_control_1">Herhaal nieuw wachtwoord</label>
                                                		<input type="password" class="form-control no-border-radius" id="form_control_1" placeholder="" value="gfbvcvcvbgfc">
                                                		
                                            		</div>
                                				</div>
                                           </div>
                                           <div class="row">
                                				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group has-info">
                                                		<label for="form_control_1">Voornaam</label>
                                                		<input type="text" class="form-control no-border-radius" id="form_control_1" placeholder="" value="Richard">
                                                		
                                            		</div>
                                            	</div>	
                                            	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group has-info">
                                                		<label for="form_control_1">Tussenvoegsel</label>
                                                		<input type="text" class="form-control no-border-radius" id="form_control_1" placeholder="" value="">
                                                		
                                            		</div>
                                				</div>
                                				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                					<div class="form-group has-info">
                                                		<label for="form_control_1">Achternaam</label>
                                                		<input type="text" class="form-control no-border-radius" id="form_control_1" placeholder="" value="Perdaan">
                                                		
                                            		</div>
                                				</div>
                                           </div>
                                           <div class="row">
												<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="geslacht">Geslacht</label>
														<select class="form-control" required="true" name="geslacht">
															<option value="man" selected="">Man</option>
															<option value="vrouw">Vrouw</option>
														</select>
													</div>
												</div>
                                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="geslacht">Taxi</label>
                                                        <select class="form-control" required="true" name="taxi">
                                                            <option value="man" selected="">78-LR-VV Opel Corsa</option>
                                                            <option value="vrouw">TJ-NZ-45 Audi A3</option>
                                                        </select>
                                                    </div>
                                                </div>	
                                           </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-actions noborder pull-right ">
                                                    <button type="button" class="btn green-meadow"><i class="fa fa-check" ></i>Opslaan</button>
                                                    <button type="button" class="btn default">Annuleren</button>
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
