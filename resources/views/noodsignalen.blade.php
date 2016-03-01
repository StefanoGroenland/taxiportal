@extends('layouts.master')

     @section('content')
             <div class="page-content">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-grey-gallery">
                            <i class="fa fa-info font-grey-gallery"></i>
                            <span class="caption-subject bold uppercase">Noodsignalen</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @include('layouts.tables.noodsignaal-table')
                    </div>
                </div>
             </div>
     @endsection
