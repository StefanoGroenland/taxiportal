@extends('layouts.master')

@section('content')  
    <div class="page-content"> 
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-grey-gallery">
                    <i class="fa fa-info font-grey-gallery"></i>
                    <span class="caption-subject bold uppercase">Reclames</span>
                </div>
            </div>
            <div class="portlet-body form">
             <a href="/reclametoevoegen" class="btn btn-sm green-meadow margin-bottom-10"><i class="fa fa-plus"></i> Reclame toevoegen</a>
                @include('layouts.tables.reclames-table')
            </div>
        </div>
    </div>
    
@endsection
