@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-plus font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Reclame toevoegen</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" action="/addAd">
                            {!! csrf_field() !!}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="link" name="link" value="">
                                                <label for="link">Link</label>
                                                <i class="fa fa-link"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="locatie" name="locatie" value="">
                                                <label for="locatie">Locatie</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="banner" name="banner" value="">
                                                <label for="banner">Banner</label>
                                                <i class="fa fa-picture-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-actions noborder pull-right">
                                        <button type="submit" class="btn green-meadow"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
                                        <a type="button" href="/reclames" class="btn default">Annuleren</a>
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
