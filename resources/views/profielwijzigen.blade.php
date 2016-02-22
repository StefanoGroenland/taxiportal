@extends('layouts.master')

@section('content')
<div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img src="{{URL::asset('../assets/img/profile_user.jpg')}}" class="img-responsive" alt=""> </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> Marcus Doe </div>
                                        <div class="profile-usertitle-job"> Developer </div>
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
                                                        <form role="form" action="#">
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="voornaam" value="" data-validation="required">
                                                                    <label for="voornaam">Voornaam</label>
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="tussenvoegsel" value="">
                                                                    <label for="tussenvoegsel">Tussenvoegsel</label>
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="achternaam" value="">
                                                                    <label for="achternaam">Achternaam</label>
                                                                    <i class="fa fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="telefoonnummer" value="">
                                                                    <label for="telefoonnummer">Telefoonnummer</label>
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="email" value="">
                                                                    <label for="emial">E-mail</label>
                                                                    <i class="fa fa-envelope-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="margiv-top-10 pull-right">
                                                                        <a href="javascript:;" class="btn green-meadow"> Opslaan </a>
                                                                        <a href="javascript:;" class="btn default"> Annuleren </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                            eiusmod. </p>
                                                        <form action="#" role="form">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new">Selecteer profiel foto</span>
                                                                                <span class="fileinput-exists"> Verander </span>
                                                                                <input type="file" name="..."> 
                                                                            </span>
                                                                        <a href="javascript:;" class="btn red-intense fileinput-exists" data-dismiss="fileinput"> Verwijder </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="margiv-top-10 pull-right">
                                                                        <a href="javascript:;" class="btn green-meadow"> Opslaan </a>
                                                                        <a href="javascript:;" class="btn default"> Annuleren </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <form action="#">
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="huidig_wachtwoord" value="">
                                                                    <label for="huidig_wachtwoord">Huidig wachtwoord</label>
                                                                    <i class="fa fa-key"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="nieuw_wachtwoord" value="">
                                                                    <label for="nieuw_wachtwoord">Nieuw wachtwoord</label>
                                                                    <i class="fa fa-key"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-md-line-input">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control" id="herhaal_nieuw_wachtwoord" value="">
                                                                    <label for="herhaal_nieuw_wachtwoord">Herhaal nieuw wachtwoord</label>
                                                                    <i class="fa fa-key"></i>
                                                                </div>
                                                            </div>
                                                             <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="margiv-top-10 pull-right">
                                                                        <a href="javascript:;" class="btn green-meadow"> Verander wachtwoord </a>
                                                                        <a href="javascript:;" class="btn default"> Annuleren </a>
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
<script src="{{URL::asset('../assets/js/locale/messages.en.js')}}"></script>
<script>
$(function() {
    $('form').jvalidate({
        errorMessage: true
    });
});
</script>
@endsection