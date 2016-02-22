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
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                            <th>Reclame nummer</th> 
                            <th>Link</th> 
                            <th>Locaties</th>                           
                            <th>Aantal kliks</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>312</td>
                                <td>www.moodles.nl</td>
                                <td>Rotterdam</td>
                                <td>123</td>
                                <td width="12%" class="text-right">
                                    <a class="btn btn-sm green-meadow" href="/reclamewijzigen"><i class="fa fa-pencil"></i></a>
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
