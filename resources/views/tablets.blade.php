@extends('layouts.master')

@section('content')  
    <div class="page-content"> 
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-grey-gallery">
                    <i class="fa fa-info font-grey-gallery"></i>
                    <span class="caption-subject bold uppercase">Tablets</span>
                </div>
            </div>
            @if(Auth::user()->user_rank == 'admin')
             <a href="/tablettoevoegen" class="btn btn-sm green-meadow margin-bottom-10"><i class="fa fa-plus"></i> Tablet toevoegen</a>
            @endif
            <div class="portlet-body form">
                @include('layouts.tables.tablet-table')
            </div>
        </div>
    </div>
@endsection
