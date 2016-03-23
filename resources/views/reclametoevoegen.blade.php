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
                        <form role="form" method="POST" action="/addAd" onsubmit="return checkCoords();" files="true" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-body">
                            <div class="row">
                                    <div class="col-lg-12 col-md-12 center-block text-center">
                                        <div id="imgHolder" class="fileinput-new center-block" style="height: 135px !important;">
                                            <img id="blah"
                                             src="https://placeholdit.imgix.net/~text?txtsize=33&txt=1280%C3%97135&w=1280&h=135"
                                             alt="avatar" class="img-responsive center-block"
                                             style=" width: 75% !important; height: 135px !important; padding-bottom:10px !important;"
                                            />
                                        </div>
                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                            <div>
                                                <span class="btn btn-success" id="verkennerButton" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                                                <input name="banner" id="imgInp"  style="display: none;" type='file'>
                                            </div>
                                        </div>
                                    </div>
                            </div>
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
                                                <label for="locatie">Centrale locatie</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="number" class="form-control" id="radius" name="radius" value="0">
                                                <label for="locatie">Straal reclame bereik in kilometers</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-actions noborder pull-right">
                                        <a type="button" href="/reclames" class="btn default">Annuleren</a>
                                        <button type="submit" class="btn green-meadow"><i class="fa fa-plus" aria-hidden="true"></i>Toevoegen</button>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyBuzlPSNhmRIEhIl-3ZUidj3fwXfsDSw&amp;sensor=false&libraries=places"></script>
<script type="text/javascript" src="{{URL::asset('/assets/js/jquery.geocomplete.min.js')}}"></script>

<script>
$(function() {
    $('form').jvalidate({
        errorMessage: true
    });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});





</script>
@endsection