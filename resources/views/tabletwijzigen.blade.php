@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-cog font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Wijzig tablet </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="tablet_naam" value="TAB-1234">
                                                <label for="tablet_naam">Tablet naam</label>
                                                <i class="fa fa-tablet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="password" class="form-control" id="wachtwoord" value="06-ZGD-0">
                                                <label for="wachtwoord">Wachtwoord</label>
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="password" class="form-control" id="herhaal_wachtwoord" value="06-ZGD-0">
                                                <label for="herhaal_wachtwoord">Herhaal wachtwoord</label>
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <select class="form-control" id="taxi">
                                                    <option value=""></option>
                                                    <option value="1">Taxi 1</option>
                                                    <option value="2">Taxi 2</option>
                                                    <option value="3">Taxi 3</option>
                                                    <option value="4"a>Taxi 4</option>
                                                </select>
                                                <label for="taxi">Taxi</label>
                                                <i class="fa fa-taxi"></i>
                                            </div>
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
