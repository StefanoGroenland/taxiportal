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
                                        <span class="caption-subject bold uppercase"> Chauffeur toevoegen</span>
                                    </div>
                                </div>
                                <form method="POST" class="formulier" onsubmit="return checkCoords();" action="/addDriver" files="true" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="hidden" id="x" name="x">
                                    <input type="hidden" id="y" name="y">
                                    <input type="hidden" id="w" name="w">
                                    <input type="hidden" id="h" name="h">
                                    <div class="profile-sidebar">
                                        <div class="profile-sidebar-portlet">
                                            <div class="profile-usertitle">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 center-block">
                                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                                            <div id="jcrop_target" class="fileinput-new thumbnail center-block" style="width: 200px; height: 200px;">
                                                                <img id="jcrop_target" style=" height:100% width:80%;" src="../assets/img/avatars/avatar.png" alt="gfxuser" class="img-responsive center-block"/>
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
                                    <div class="profile-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet-body">
                                                    <div class="general-item-list">
                                                        <div class="form-body">
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
                                                           </div>
                                                            <div class="row">
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
                                                            </div>
                                                            <div class="row">
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
                                                                    <div class="form-group form-md-line-input ">
                                                                        <div class="input-icon">
                                                                            <input type="number" class="form-control" id="driver_exp" name="driver_exp" data-validate="required|number" value="{{old('drivers_exp')}}">
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
                                                                            <textarea class="form-control" id="global_information" name="global_information" rows="1">{{old('global_information')}}</textarea>
                                                                            <label for="global_information">Informatie</label>
                                                                            <i class="fa fa-info"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group form-md-line-input ">
                                                                        <div class="input-icon">
                                                                            <select class="form-control" id="car" name="car">
                                                                                <option>Niet koppelen</option>
                                                                                @if($carCount > 0)
                                                                                    @foreach($cars as $car)
                                                                                        <option value="{{$car->id}}">{{ $car->license_plate .' - '. $car->car_brand .' - '. $car->car_model .' - '. $car->car_color}}</option>  
                                                                                    @endforeach
                                                                                @else
                                                                                    <option>Geen auto's koppelbaar</option>
                                                                                @endif
                                                                            </select>
                                                                            <label for="car">Taxi</label>
                                                                             <i class="fa fa-taxi"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-actions noborder pull-right">
                                                                        <button type="submit" class="btn green-meadow sendButton"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
                                                                        <a type="button" href="/chauffeurs" class="btn default">Annuleren</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
<script src="{{URL::asset('../assets/js/jvalidate.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('../assets/js/locale/messages.nl.js')}}" type="text/javascript"></script>
<script>
    $(function() {
        $('form').jvalidate({ 
            errorMessage: true
        });
    });

    $("#radvrouw").on("click",function(){
       $('#radman').prop('checked',false)
    });
    $("#radman").on("click",function(){
       $('#radvrouw').prop('checked',false)
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
    };


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.jcrop-holder img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function checkCoords()
    {
        if (parseInt(jQuery('#w').val())>0) return true;
        return true;
    };

    jQuery(function($) {
        var input = $('#imgInp');
          $('#imgInp').change(function(){
          if(input.val() !== ""){
             $('#jcrop_target').Jcrop({
                 bgColor:     'transparant',
                 setSelect:   [ 0, 0, 200, 200 ],
                 bgOpacity:   .4,
                 aspectRatio: 1,
                 onSelect: updateCoords
             });
            }
          });
        });

</script>
@endsection