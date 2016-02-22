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
            <div class="portlet-body form">
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                            <th>Tablet naam</th>
                            <th>Taxi</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TAB-1234</td> 
                                <td>Taxi 1</td>                                
                                <td width="12%" class="text-right">
                                    <a class="btn btn-sm green-meadow" href="/tabletwijzigen"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
