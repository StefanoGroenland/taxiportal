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
                    <form role="form" method="POST" action="/addAd/{{$type}}" onsubmit="return checkCoords();" files="true" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" id="x" name="x">
                        <input type="hidden" id="y" name="y">
                        <input type="hidden" id="w" name="w">
                        <input type="hidden" id="h" name="h">
                            @if($type == 'bottom')
                                @include('layouts.reclame-bottom-add')
                            @elseif($type == 'center')
                                @include('layouts.reclame-center-add')
                            @else
                                @include('layouts.reclame-side-add')
                            @endif
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
    $("#saveBtn").removeClass('hide');
    console.log("changed!");
        readURL(this);
    });

    function updateCoords(c)
    {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
        console.log(c);
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
        return false;
    };

    jQuery(function($) {
        var input = $('#imgInp');
            $('#imgInp').change(function(){
            if(input.val() !== ""){
                $('#jcrop_target').Jcrop({
                     bgColor:     'transparant',
                     setSelect:   [ 0, 0, 200, 200],
                     bgOpacity:   .4,
                     aspectRatio: 160/600,
                     onSelect: updateCoords
                });
            }
            });
        });

</script>
@endsection