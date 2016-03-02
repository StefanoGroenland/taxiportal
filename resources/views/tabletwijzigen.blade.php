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
                            <span class="caption-subject bold uppercase"> Wijzig tablet </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" action="/editTablet/{{$id}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="tablet_naam" data-validate="required|maxlength:50" name="tablet" value="@if(old('tablet_name')){{old('tablet_name')}}@else{{$user->tablet_name}}@endif">
                                                <label for="tablet_naam">Tablet naam</label>
                                                <i class="fa fa-tablet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <select class="form-control" id="taxi" name="taxi">
                                                   @foreach($cars as $car)
                                                       @if($cars)
                                                           <option @if(old('taxi_id') == $tablet->taxi_id) selected  @elseif($tablet->taxi_id == $car->id) selected @endif value="{{$car->id}}">{{$car->license_plate}}</option>
                                                       @else
                                                           <option value="0">Geen auto beschikbaar</option>
                                                       @endif
                                                   @endforeach
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
                                            <button type="submit" class="btn green-meadow"><i class="fa fa-check" ></i>Opslaan</button>
                                            <a href="/tablets" class="btn default">Annuleren</a>
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
</script>
@endsection