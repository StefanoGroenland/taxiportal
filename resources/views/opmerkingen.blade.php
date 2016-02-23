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
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                            <th>Kenteken</th>
                            <th>Chauffeur</th>
                            <th>Beoordeling</th>
                            <th>Opmerking</th>
                            <th>Opmerking geplaatst op</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>06-ZGD-0</td>
                                <td>Richard Perdaan</td>
                                <td>
                                    <i style="color:gold;" class="fa fa-star"></i>
                                    <i style="color:gold;" class="fa fa-star"></i>
                                    <i style="color:gold;" class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </td>
                                <td>Dit is een opmerking :p</td>
                                <td>13:26 22-02-2016</td>
                                <td width="12%" class="text-right">
                                    <a class="btn btn-sm green-meadow" href="/opmerkingwijzigen"><i class="fa fa-pencil"></i></a>
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