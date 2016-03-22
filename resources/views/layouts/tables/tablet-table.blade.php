<table class="table table-hover" >
        <thead>
            <th>Tablet naam</th>
            <th>Chauffeur</th>
            <th>Taxi</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($tablets as $tablet)
                <tr data-href="/tabletwijzigen/{{$tablet->id}}">
                    <td>{{$tablet->user->tablet_name}}</td>
                    @if($tablet->taxi && $tablet->taxi->driver && $tablet->taxi->driver->user)
                        <td>{{$tablet->taxi->driver->user->firstname .' '. $tablet->taxi->driver->user->lastname}}</td>
                    @else
                        <td>Geen chauffeur</td>
                    @endif
                    @if($tablet->taxi)
                    <td>{{$tablet->taxi->license_plate .', '. $tablet->taxi->car_brand .' '. $tablet->taxi->car_model}} </td>
                    @else
                    <td>Geen taxi gekoppeld</td>
                    @endif
                    <td width="12%" class="text-right">
                        <a class="btn btn-sm blue popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Tablet wijzigen" href="/tabletwijzigen/{{$tablet->id}}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo deleteButton popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Tablet verwijderen" data-model-id="{{$tablet->id}}" data-toggle="modal" href="#myModel{{$tablet->id}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

@foreach($tablets as $tablet)
    @if($tablet && $tablet->user)
    <div class="modal fade" id="myModel{{$tablet->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de tablet: <strong>{{$tablet->user->tablet_name}}</strong> wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteTablet/{{$tablet->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder tablet</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    @endif
@endforeach