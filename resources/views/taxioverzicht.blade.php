@extends('layouts.master')

@section('content')  
            <div class="page-content">
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
                            <span class="caption-subject bold uppercase">Taxi's</span>

                        </div>
                        <a href="/taxitoevoegen" class="btn btn-sm green-meadow pull-right"><i class="fa fa-plus"></i> Taxi toevoegen</a>
                    </div>
                    <div class="portlet-body form">
                        @include('layouts.tables.taxi-table')
                    </div>
                </div>
            </div>
           
@endsection
