<div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Tablet naam</th>
            <th>Chauffeur</th>
            <th>Taxi</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($tablets as $tablet)
            @if($tablet->taxi && $tablet->user)
                <tr>
                    <td>{{$tablet->user->tablet_name}}</td>
                    <td>{{$tablet->taxi->driver->user->firstname .' '. $tablet->taxi->driver->user->surname .' '. $tablet->taxi->driver->user->lastname}}</td>
                    <td>{{$tablet->taxi->license_plate .', '. $tablet->taxi->car_brand .' '. $tablet->taxi->car_model}} </td>
                    <td width="12%" class="text-right">
                        <a class="btn btn-sm green-meadow" href="/tabletwijzigen/{{$tablet->id}}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo deleteButton" data-model-id="{{$tablet->id}}" data-toggle="modal" href="#myModel{{$tablet->id}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

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