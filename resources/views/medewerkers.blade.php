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
                <div class="table-responsive">
                    <table class="table table-hover" >
                        <thead>
                            <th>Voornaam</th>
                            <th>Tussenvoegsel</th>
                            <th>Achternaam</th>
                            <th>E-mail</th>
                            <th>Telefoonnummer</th>
                            <th>Functie</th>
                            <th>Profiel foto</th>
                            <th>Beoordeling</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Richard </td>
                                <td></td>
                                <td>Perdaan</td>
                                <td>richard@moodles.nl</td>
                                <td>0123456789</td>
                                <td>Chauffeur</td>
                                <td><img src="http://moodles.nl/img/team/team-15.png" alt="Profiel foto" height="42" width="42"></td>
                                <td>
                                    <i style="color:gold;" class="fa fa-star"></i>
                                    <i style="color:gold;" class="fa fa-star"></i>
                                    <i style="color:gold;" class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </td>
                                <td width="12%" class="text-right">
                                    <a class="btn btn-sm green-meadow" href="/medewerkerwijzigen"><i class="fa fa-pencil"></i></a>
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
