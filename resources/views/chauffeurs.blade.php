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
                        <a href="/chauffeurtoevoegen" class="btn btn-sm green-meadow margin-bottom-10"><i class="fa fa-plus"></i> Chauffeur toevoegen</a>
                            <div class="table-responsive">
                                <table class="table table-hover" >
                                    <thead>
                                        <th>Chauffeur</th>
                                        <th>Kenteken</th>
                                        <th>Email</th>
                                        <th>Telefoonnummer</th>
                                        <th>Geslacht</th>
                                        <th>Beoordeling</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Richard Perdaan</td>
                                            <td>06-ZGD-0</td>
                                            <td>richard@moodles.nl</td>
                                            <td>0123456789</td>
                                            <td>Man</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/chauffeurwijzigen"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Stefano Groenland</td>
                                            <td>78-LR-VV</td>
                                            <td>stefano@moodles.nl</td>
                                            <td>0123456789</td>
                                            <td>Man</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/chauffeurwijzigen"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>Furkan Bolukbas</td>
                                            <td>12-FR-TR</td>
                                            <td>furkan@moodles.nl</td>
                                            <td>0123456789</td>
                                            <td>Man</td>
                                            <td>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i style="color:gold;" class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                            <td width="12%" class="text-right">
                                                <a class="btn btn-sm green-meadow" href="/chauffeurwijzigen"><i class="fa fa-pencil"></i></a>
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
