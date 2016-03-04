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
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        @if(Auth::user()->profile_photo == "")
                                            <img src="../assets/img/avatars/avatar.png" class="img-responsive" alt=""></div>
                                        @else
                                            <img src="../{{Auth::user()->profile_photo}}" class="img-responsive" alt=""></div>
                                        @endif
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> {{Auth::user()->firstname .' '. Auth::user()->lastname}} </div>
                                        <div class="profile-usertitle-job"> {{Auth::user()->user_rank}} </div>
                                    </div>
                                    <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li>
                                                <a href="/profiel">
                                                    <i class="fa fa-home"></i> Overzicht 
                                                </a>
                                            </li>
                                            <li class="active">
                                                <a href="/profielwijzigen">
                                                    <i class="fa fa-cog"></i> Account instellingen
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profiel</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Verander profiel</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Verander profiel foto</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Verander wachtwoord</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                    <form role="form" class="validate" method="POST" action="/editProfile/{{$id}}">
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" name="firstname" id="voornaam" value="{{Auth::user()->firstname}}" data-validate="required">
                                                                    <label for="voornaam">Voornaam</label>
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" name="lastname" id="achternaam" value="{{Auth::user()->lastname}}" data-validate="required">
                                                                    <label for="achternaam">Achternaam</label>
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" name="phone_number" id="telefoonnummer" value="{{Auth::user()->phone_number}}" data-validate="required|number|maxlength:10">
                                                                    <label for="telefoonnummer">Telefoonnummer</label>
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" name="email" id="email" value="{{Auth::user()->email}}" data-validate="required">
                                                                    <label for="emial">E-mail</label>
                                                                    <i class="fa fa-envelope-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="margiv-top-10 pull-right">
                                                                        <button type="submit" class="btn green-meadow"><i class="fa fa-check"></i> Opslaan </button>
                                                                        <a href="/profielwijzigen" class="btn default"> Annuleren </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        <form method="POST" class="formulier" onsubmit="return checkCoords();" action="/editProfilePhoto/{{$id}}" files="true" enctype="multipart/form-data">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" id="x" name="x">
                                                        <input type="hidden" id="y" name="y">
                                                        <input type="hidden" id="w" name="w">
                                                        <input type="hidden" id="h" name="h">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 center-block">
                                                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                                                            <div id="jcrop_target" class="fileinput-new thumbnail center-block" style="width: 200px; height: 200px;">
                                                                                <img id="jcrop_target" style=" height:100%; width:100%;" src="../assets/img/avatars/avatar.png" alt="avatar" class="img-responsive center-block"/>
                                                                                <div class="jcrop-holder" style="width: 400px !important; height: 200px!important;"></div>
                                                                            </div>
                                                                            <div>
                                                                                <span class="btn btn-success center-block" id="verkennerButton" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                                                                                <input name="profile_photo" id="imgInp" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());readURL(this)" style="display: none;" type="file">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="margiv-top-10 pull-right">
                                                                        <button type="submit" class="btn green-meadow"><i class="fa fa-check"></i> Opslaan </button>
                                                                        <a href="/profielwijzigen#tab_1_2" class="btn default"> Annuleren </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                    <form role="form" class="validate" method="POST" action="/editPassword/{{$id}}">
                                                            {!! csrf_field() !!}
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="password" class="form-control" name="password" id="nieuw_wachtwoord" value="" data-validate="required|minlenght:4">
                                                                    <label for="nieuw_wachtwoord">Nieuw wachtwoord</label>
                                                                    <i class="fa fa-key"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="password" class="form-control" name="password_confirmation" id="herhaal_nieuw_wachtwoord" value="" data-validate="required|minlenght:4">
                                                                    <label for="herhaal_nieuw_wachtwoord">Herhaal nieuw wachtwoord</label>
                                                                    <i class="fa fa-key"></i>
                                                                </div>
                                                            </div>
                                                             <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="margiv-top-10 pull-right">
                                                                        <button type="submit" class="btn green-meadow"><i class="fa fa-check"></i> Opslaan</button>
                                                                        <a href="/profielwijzigen#tab_1_3" class="btn default"> Annuleren </a>
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
                
@endsection
@section('scripts')
<script src="{{URL::asset('../assets/js/jvalidate.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('../assets/js/locale/messages.nl.js')}}"></script>
<script>
$(function() {
        $('.validate').jvalidate({
            errorMessage: true
        });
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
    console.log("changed!");
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