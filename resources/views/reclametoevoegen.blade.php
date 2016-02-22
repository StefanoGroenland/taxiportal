@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="portlet light bordered">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-grey-gallery">
                                <i class="fa fa-plus font-grey-gallery"></i>
                                <span class="caption-subject bold uppercase"> Wijzig reclame </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group form-md-line-input">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" id="reclame_nummer" value="">
                                                    <label for="reclame_nummer">Reclame nummer</label>
                                                    <i class="fa fa-picture-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group form-md-line-input">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" id="link" value="">
                                                    <label for="link">Link</label>
                                                    <i class="fa fa-link"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group form-md-line-input">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" id="locatie" value="">
                                                    <label for="locatie">Locatie</label>
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group form-md-line-input">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" id="kliks" value="">
                                                    <label for="kliks">Aantal kliks</label>
                                                    <i class="fa fa-hand-o-down"></i>
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
