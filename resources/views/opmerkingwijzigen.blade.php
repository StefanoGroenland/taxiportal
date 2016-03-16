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
                            <span class="caption-subject bold uppercase"> Wijzig/accepteer een opmerking </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="POST" action="/editComment/{{$id}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" disabled id="kenteken" value="{{$comment->driver->taxi->license_plate}}">
                                                <label for="kenteken">Kenteken</label>
                                                <i class="fa fa-taxi"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                                <input type="text" disabled class="form-control" id="chauffeur" value="{{$comment->driver->user->firstname}}">
                                                <label for="chauffeur">Chauffeur</label>
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-line-input ">
                                            <div class="input-icon">
                                                <select class="form-control" id="status" name="approved">
                                                    <option @if(old('approved') == 0) selected  @elseif($comment->approved == 0) selected @endif value="0">Niet geaccepteerd</option>
                                                    <option @if(old('approved') == 1) selected  @elseif($comment->approved == 1) selected @endif value="1">Geaccepteerd</option>
                                                </select>
                                                <label for="status">Status</label>
                                                <i class="fa fa-tag"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                        <div class="form-group form-md-line-input">
                                            <div class="input-icon">
                                            @if(old('comment'))
                                                <textarea class="form-control" rows="5" id="comment" name="comment">{!! old('comment') !!}</textarea>
                                            @else
                                                <textarea class="form-control" rows="5" id="comment" name="comment">{!! $comment->comment !!}</textarea>
                                            @endif
                                                <label for="comment">Opmerking</label>
                                            </div>
                                            De pasagier beoordeelde de rit met :
                                            @for($i = 0; $i < $comment->star_rating; $i++)
                                                <i style="color:gold;" class="fa fa-star"></i>
                                            @endfor
                                            sterren
                                        </div>
                                    </div>
                                   
                               </div>
                               <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-actions noborder pull-right">
                                        <a href="/opmerkingen" type="button" class="btn default">Annuleren</a>
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
