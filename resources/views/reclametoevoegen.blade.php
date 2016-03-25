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