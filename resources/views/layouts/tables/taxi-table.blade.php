<table class="table table-hover" >
        <thead>
            <th>Kenteken</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Kleur</th>
            <th>Chauffeur</th>
            <th>Locatie<small>(latitude, longtitude)</small></th>
            <th>Laatst gezien</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($taxis as $taxi)
                    <tr data-href="/taxiwijzigen/{{$taxi->id}}">
                        <td>{{$taxi->license_plate}}</td>
                        <td>{{$taxi->car_brand}}</td>
                        <td>{{$taxi->car_model}}</td>
                        <td>{{$taxi->car_color}}</td>
                        @if($taxi->driver && $taxi->driver->user)
                            <td>{{$taxi->driver->user->firstname .' '. $taxi->driver->user->surname .' '. $taxi->driver->user->lastname}}</td>
                        @else
                            <td>Geen chauffeur gekoppeld</td>
                        @endif
                        <td>{{$taxi->last_latitude .' - '. $taxi->last_longtitude}}</td>
                        <td>@if($taxi->in_shift == 1)
                                <i class="fa fa-circle" style="color: #41f800;" ></i>
                            @else
                                <i class="fa fa-circle" style="color: #F85200;" ></i> 
                            @endif 
                            @if($taxi->last_seen != '0000-00-00 00:00:00')
                                <small>{{date('d-m-Y H:i',strtotime($taxi->last_seen))}}</small>
                            @else
                                <small>Geen</small>
                            @endif 
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm blue popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Taxi wijzigen" href="/taxiwijzigen/{{$taxi->id}}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm red-sunglo deleteButton popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Taxi verwijderen" data-model-id="{{$taxi->id}}" data-toggle="modal" href="#myModel{{$taxi->id}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
@foreach($taxis as $taxi)
    @if($taxi)
    <div class="modal fade" id="myModel{{$taxi->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de chauffeur: <strong>{{$taxi->license_plate}}</strong> wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteTaxi/{{$taxi->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder Taxi</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    @endif
@endforeach