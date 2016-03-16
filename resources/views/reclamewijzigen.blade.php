@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-cog font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Wijzig reclame </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" action="/editAd/{{$id}}" onsubmit="return checkCoords();" files="true" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-body">
                            <div class="row">
                            <div class="col-lg-2 col-md-2"></div>
                            <div class="col-lg-8 col-md-8  center-block text-center">
                                <div class="form-group form-md-line-input">
                                    <span class="alert alert-warning" >Afbeelding afmeting 1280x200</span>
                                    <div class="form-group form-md-line-input">
                                            <div class="row">
                                                <div class="center-block">
                                                <div id="imgHolder" class="fileinput-new thumbnail center-block" >
                                                        <img id="blah"
                                                         src="../{{$obj->banner}}"
                                                         alt="avatar" class="img-responsive center-block"
                                                         style="width: 100% !important; height: 200px !important;"
                                                        />
                                                    </div>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div>
                                                            <span class="btn btn-success" id="verkennerButton" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                                                            <input name="banner" id="imgInp"  style="display: none;" type='file'>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 "></div>
                            </div>
                                <div class="row">
                                <div class="col-lg-2 col-md-2"></div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" name="link" class="form-control" id="link" value="{{$obj->link}}">
                                                <label for="link">Link</label>
                                                <i class="fa fa-link"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" name="location" class="form-control" id="locatie"
                                                value="{{$locations}}">
                                                <label for="locatie">Locatie</label>
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-actions noborder pull-right">
                                        <a type="button" href="/reclames" class="btn default">Annuleren</a>
                                        <button type="submit" class="btn green-meadow"><i class="fa fa-check" aria-hidden="true"></i>Opslaan</button>
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
@section('scripts')
<script src="{{URL::asset('../assets/js/jvalidate.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('../assets/js/locale/messages.nl.js')}}" type="text/javascript"></script>

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
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURL(this);
            });


</script>
@endsection