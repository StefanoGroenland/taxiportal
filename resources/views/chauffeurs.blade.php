 @extends('layouts.master')

@section('content')  
        <div class="page-content"> 
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-grey-gallery">
                                <i class="fa fa-info font-grey-gallery"></i>
                                <span class="caption-subject bold uppercase">Chauffeurs</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            @include('layouts.tables.chauffeurs-table')
                        </div>
                    </div>
                </div>
           
@endsection
