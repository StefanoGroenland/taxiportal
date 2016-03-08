@extends('layouts.master')

@section('content')  
    <div class="page-content"> 
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-grey-gallery">
                    <i class="fa fa-info font-grey-gallery"></i>
                    <span class="caption-subject bold uppercase">Opmerkingen</span>
                </div>
            </div>
            <div class="portlet-body form">
                @if(Auth::user()->user_rank == 'admin')
                    @include('layouts.tables.opmerkingen-table')
                @else
                    @include('layouts.tables.opmerkingen-chauffeur-table')
                @endif
            </div>
        </div>
    </div>
@endsection