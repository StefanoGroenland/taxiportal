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
                                    <form method="POST"  class="formulier" onsubmit="return checkCoords();" action="/addTaxi" files="true" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        <input type="hidden" id="x" name="x">
                                        <input type="hidden" id="y" name="y">
                                        <input type="hidden" id="w" name="w">
                                        <input type="hidden" id="h" name="h">
                                        <div class="form-body">
                                        <fieldset id="fieldset-origin">
                                        <div class="row">
                                			<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                <div class="plate-form">
                                                    <span class="eu"></span>
                                                    <input type="text" class="kenteken_input" id="license_plate" name="license_plate" data-validate="required|maxlength:8" value="{{old('license_plate')}}">
                                                </div>                        
                							</div>
                                                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_brand" name="car_brand" data-validate="required" value="{{old('car_brand')}}">
                                                            <label for="merk">Merk</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>

                                           		<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_model" name="car_model" data-validate="required" value="{{old('car_model')}}">
                                                            <label for="model">Model</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group form-md-line-input">
                                                        <div class="input-icon">
                                                            <input type="text" class="form-control" id="car_color" name="car_color" data-validate="required" value="{{old('car_color')}}">
                                                            <label for="kleur">Kleur</label>
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
												</div>
                                				<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                					<div class="form-group form-md-line-input ">
                                                    	<div class="input-icon">
                                                            <select class="form-control" id="driver" name="driver" data-validate="required" value="{{old('driver')}}">
                                                                <option value="0">Niet koppelen</option>
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
                                				<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">

                                                    <label for="geslacht">Chauffeur optie</label>
                                                    <div class="form-group" data-validate="group">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="create_driver" id="radAssign" class="md-radiobtn" value="assign" checked="" @if(old('create_driver') == 'assign') checked @endif> Koppel
                                                        </label>
                                                        <label class="radio-inline" >
                                                            <input type="radio" name="create_driver" id="radCreate" class="md-radiobtn" value="create"  @if(old('create_driver') == 'create') checked @endif> Maak
                                                        </label>
                                                    </div>
                                                </div>
                                           </div>
                                           </fieldset>
										<div class="row">
											<div class="col-lg-12">
												<fieldset id="fieldset-driver" class="hide" disabled>
													<hr>
													<i class="fa fa-plus font-grey-gallery"></i>
													<span class="caption-subject bold uppercase"> Chauffeur toevoegen</span>
													<div class="row margin-top-40">
														<div class="profile-sidebar">
															<div class="profile-sidebar-portlet">
																<div class="profile-usertitle">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block">
																			<div class="fileinput fileinput-new " data-provides="fileinput">
																				<div id="jcrop_target" class="fileinput-new thumbnail center-block" style="width: 200px; height: 200px;">
																					<img id="jcrop_target" style=" height:100%; width:100%;" src="../assets/img/avatars/avatar.png" alt="avatar" class="img-responsive center-block"/>
																					<div class="jcrop-holder" style="width: 400px !important; height: 200px!important;"></div>
																				</div>
																				<div>
																					<span class="btn btn-success" id="verkennerButton" data-toggle="tooltip" title="Kies een foto" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
																					<input name="profile_photo" id="imgInp" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());readURL(this)" style="display: none;" type="file">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
															<div class="row">
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="text" class="form-control" id="email" name="email" data-validate="required|email|max:50" value="{{old('email')}}">
																			<label for="email">E-mail</label>
																			<i class="fa fa-envelope-o"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="text" class="form-control" id="telefoonnummer" name="phonenumber" data-validate="required|number|minlength:10|maxlength:10" value="{{old('phone_number')}}">
																			<label for="telefoonnummer">Telefoonnummer</label>
																			<i class="fa fa-phone"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="text" class="form-control" id="voornaam" name="firstname" data-validate="required" value="{{old('firstname')}}">
																			<label for="voornaam">Voornaam</label>
																			<i class="fa fa-user"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="text" class="form-control" id="achternaam" name="lastname" data-validate="required" value="{{old('lastname')}}">
																			<label for="achternaam">Achternaam</label>
																			<i class="fa fa-user"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="password" class="form-control" id="password" name="password" data-validate="required|minlength:4|same:#password_confirmation" data-name="Wachtwoord">
																			<label for="wachtwoord">Wachtwoord</label>
																			<i class="fa fa-key"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-validate="required|minlength:4|same:#password" data-name="Herhaal wachtwoord">
																			<label for="herhaal_wachtwoord">Herhaal wachtwoord</label>
																			<i class="fa fa-key"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<label for="geslacht">Geslacht</label>
																	<div class="form-group" data-validate="group">
																		<label class="radio-inline" >
																			<input type="radio" name="sex" id="radman" class="md-radiobtn" value="man" checked="" @if(old('sex') == 'man') checked @endif> Man
																		</label>
																		<label class="radio-inline">
																			<input type="radio" name="sex" id="radvrouw" class="md-radiobtn" value="vrouw" @if(old('sex') == 'vrouw') checked @endif> Vrouw
																		</label>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<input type="number" class="form-control" id="driver_exp" name="driver_exp" data-validate="required|number" value="{{old('drivers_exp')}}">
																			<label for="driver_exp">Rijervaring (jaren)</label>
																			<i class="fa fa-user"></i>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group form-md-line-input">
																		<div class="input-icon">
																			<textarea class="form-control" id="global_information" name="global_information" rows="3">{{old('global_information')}}</textarea>
																			<label for="global_information">Informatie</label>
																			<i class="fa fa-info"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</fieldset>
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
    $(function(){
      $("#radAssign").click();
    });

  $("#license_plate").bind("change", function(e){
    var x = $("#license_plate").val();
    var trimOne = x.replace('-','');
    var trimmed = trimOne.replace('-','');
    var final = trimmed.toUpperCase();

    $.getJSON("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken="+ final +"",
          function(data){
            $.each(data, function(){
                console.log(data[0]);
                $("#license_plate").val(data[0]['kenteken']);
                $("#car_brand").val(data[0]['merk']);
                $("#car_model").val(data[0]['handelsbenaming']);
                $("#car_color").val(data[0]['eerste_kleur']);
            });
          });
        });
           $("#radCreate").on("click",function(){
		        $('#driver').prop('disabled',true);
		        $('#fieldset-driver').prop('disabled',false);
		        $('#fieldset-driver').removeClass('hide');
		        $('#email').attr('data-validate','required|email|max:50');
                $('#telefoonnummer').attr('data-validate','required|number|minlength:10|maxlength:10');
                $('#voornaam').attr('data-validate','required');
                $('#achternaam').attr('data-validate','required');
                $('#password').attr('data-validate','required|minlength:4|same:#password_confirmation');
                $('#password_confirmation').attr('data-validate','required|minlength:4|same:#password');
                $('#driver_exp').attr('data-validate','required|number');
		   });
		   $("#radAssign").on("click",function(){
                $('#driver').prop('disabled',false);
                $('#fieldset-driver').prop('disabled',true);
                $('#fieldset-driver').addClass('hide');

                $('#email').attr('data-validate','');
                $('#telefoonnummer').attr('data-validate','');
                $('#voornaam').attr('data-validate','');
                $('#achternaam').attr('data-validate','');
                $('#password').attr('data-validate','');
                $('#password_confirmation').attr('data-validate','');
                $('#driver_exp').attr('data-validate','');
		   });
           $('#imgInp').change(function(){
               var input = $('#imgInp');
               var sendButton = $('.sendButton');
               if(input === 0){
                   sendButton.attr("disabled", true);
               }else{
                   sendButton.attr("disabled", false);
               }
           });

           $("#imgInp").change(function(){
               readURL(this);
           });

           function updateCoords(c)
           {
               $('#x').val(c.x);
               $('#y').val(c.y);
               $('#w').val(c.w);
               $('#h').val(c.h);
           }

           function readURL(input) {
               if (input.files && input.files[0]) {
                   var reader = new FileReader();
                   reader.onload = function (e) {
                       $('.jcrop-holder img').attr('src', e.target.result);
                   };
                   reader.readAsDataURL(input.files[0]);
               }
           }
           function checkCoords()
           {
               if (parseInt(jQuery('#w').val())>0) return true;
               return true;
           }

           jQuery(function($) {
               var input = $('#imgInp');
                 $('#imgInp').change(function(){
                 if(input.val() !== ""){
                    $('#jcrop_target').Jcrop({
                        bgColor:     'transparant',
                        setSelect:   [ 0, 0, 200, 200 ],
                        bgOpacity:   .4,
                        aspectRatio: 1,
                        onSelect: updateCoords,
                        onChange: updateCoords
                    });
                 }
               });
           });

    </script>
@endsection
