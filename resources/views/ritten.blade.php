@extends('layouts.master')

    @section('content')
            <div class="page-content">
               <div class="portlet light bordered">
                   <div class="portlet-title">
                       <div class="caption font-grey-gallery">
                           <i class="fa fa-info font-grey-gallery"></i>
                           <span class="caption-subject bold uppercase">Ritten</span>
                       </div>
                   </div>
                   <div class="portlet-body form">
                   @if(Auth::user()->user_rank == 'admin')
                    <a href="/rittoevoegen" class="btn btn-sm green-meadow margin-bottom-10"><i class="fa fa-plus"></i> Rit toevoegen</a>
                   @endif
                       @include('layouts.tables.ritten-table')
                   </div>
               </div>
            </div>
    @endsection
