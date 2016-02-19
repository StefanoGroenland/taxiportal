@extends('layouts.master')

@section('content')  
        <div class="page-content"> 
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-grey-gallery">
                                <i class="fa fa-info font-grey-gallery"></i>
                                <span class="caption-subject bold uppercase">Taxi's</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                        <a href="/taxitoevoegen" class="btn btn-sm green-meadow margin-bottom-10"><i class="fa fa-plus"></i> Taxi toevoegen</a>
                            <div class="table-responsive">
                                <table class="table table-hover" >
                                    <thead>
                                        <th>Kenteken</th>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Kleur</th>
                                        <th>Chauffeur</th>
                                        <th>Beoordeling</th>
                                        <th>Locatie</th>
                                        <th>Laatst gezien</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>06-ZGD-0</td>
                                            <td>Opel</td>
                                            <td>Corsa</td>
                                            <td>Rood</td>
                                            <td>Richard Perdaan</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td>Rotterdam</td>
                                            <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/taxiwijzigen"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>06-ZGD-0</td>
                                            <td>Opel</td>
                                            <td>Corsa</td>
                                            <td>Rood</td>
                                            <td>Richard Perdaan</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td>Rotterdam</td>
                                            <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/taxiwijzigen"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>06-ZGD-0</td>
                                            <td>Opel</td>
                                            <td>Corsa</td>
                                            <td>Rood</td>
                                            <td>Richard Perdaan</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td>Rotterdam</td>
                                            <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/taxiwijzigen"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>06-ZGD-0</td>
                                            <td>Opel</td>
                                            <td>Corsa</td>
                                            <td>Rood</td>
                                            <td>Richard Perdaan</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td>Rotterdam</td>
                                            <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/taxiwijzigen"><i class="fa fa-pencil"></i></a>
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
