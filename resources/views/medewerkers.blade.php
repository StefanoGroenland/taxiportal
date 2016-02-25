@extends('layouts.master')

@section('content')  
    <div class="page-content"> 
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-grey-gallery">
                    <i class="fa fa-info font-grey-gallery"></i>
                    <span class="caption-subject bold uppercase">Medewerkers</span>
                </div>
            </div>
            <div class="portlet-body form">
             <a href="/medewerkertoevoegen" class="btn btn-sm green-meadow margin-bottom-10"><i class="fa fa-plus"></i> Medewerker toevoegen</a>
                   @include('layouts.tables.medewerkers-table')
            </div>
        </div>
    </div>
@endsection
