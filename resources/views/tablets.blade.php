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
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-grey-gallery">
                    <i class="fa fa-info font-grey-gallery"></i>
                    <span class="caption-subject bold uppercase">Tablets</span>
                </div>
                 <a href="/tablettoevoegen" class="btn btn-sm green-meadow pull-right"><i class="fa fa-plus"></i> Tablet toevoegen</a>
            </div>

            <div class="portlet-body form">
                @include('layouts.tables.tablet-table')
            </div>
        </div>
    </div>
@endsection
