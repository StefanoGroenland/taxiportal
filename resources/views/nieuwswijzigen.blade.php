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
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-cog font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase"> Wijzig nieuwsgroep </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" onsubmit="return checkCoords();" action="/editNews/{{$id}}"  files="true" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-5"></div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="center-block text-center">
                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                            <div id="jcrop_target" name="avatar" class="fileinput-new thumbnail center-block" style="width: 200px; height: 200px;">
                                                <img id="jcrop_target" style=" margin-left: auto !important" src="
                                                @if(!$news->logo)
                                                    {{"../assets/img/avatars/avatar.png"}}
                                                @else
                                                   ../{{$news->logo}}
                                                @endif" alt="gfxuser" class="img-responsive center-block"/>
                                                <div class="jcrop-holder" style="width: 100% !important; height: 100%!important;"></div>
                                            </div>
                                            <div>
                                                <span class="btn btn-success" id="verkennerButton" data-toggle="tooltip" title="Kies een foto" onclick="$(this).parent().find('input[type=file]').click();">Verkenner</span>
                                                <input name="logo" id="imgInp" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());readURL(this)" style="display: none;" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5"></div>

                            </div>
                                <div class="row">
                                <div class="col-lg-2 col-md-2"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="tablet_naam" data-validate="required|maxlength:50" name="name" value="@if(old('name')){{old('name')}}@else{{$news->name}}@endif">
                                                <label for="tablet_naam">Nieuwsgroep</label>
                                                <i class="fa fa-tablet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="tablet_naam" data-validate="required" name="link" value="@if(old('link')){{old('link')}}@else{{$news->link}}@endif">
                                                <label for="tablet_naam">RSS feed link</label>
                                                <i class="fa fa-tablet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <input type="hidden" id="x" name="x">
                                    <input type="hidden" id="y" name="y">
                                    <input type="hidden" id="w" name="w">
                                    <input type="hidden" id="h" name="h">
                                    </div>
                                    <div class="col-lg-2 col-md-2"></div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-actions noborder pull-right">
                                            <a href="/nieuws" class="btn default">Annuleren</a>
                                            <button type="submit" class="btn green-meadow"><i class="fa fa-check" ></i>Opslaan</button>
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