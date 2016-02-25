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

        @foreach($drivers as $driver)
        @if($driver->user)
                <tr>
                    <td>{{$driver->user->firstname .' '. $driver->user->surname .' '. $driver->user->lastname}}</td>
                    <td>
                    @if($driver->taxi)
                    {{$driver->taxi->license_plate}}
                    @else
                    Geen taxi koppeling
                    @endif
                    </td>
                    <td>{{$driver->user->email}}</td>
                    <td>{{$driver->user->phone_number}}</td>
                    <td>{{$driver->user->sex}}</td>
                    <td>
                        @for($i = 0; $i < $driver->star_rating; $i++)
                            <i style="color:gold;" class="fa fa-star"></i>
                        @endfor
                    </td>
                    <td width="12%" class="text-right">
                        <a class="btn btn-sm green-meadow" href="/chauffeurwijzigen/{{$driver->user->id}}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo deleteButton" data-model-id="{{$driver->user->id}}" data-toggle="modal" href="#myModel{{$driver->user->id}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
        @endif
        @endforeach
        </tbody>
    </table>
</div>
@foreach($drivers as $driver)
    <div class="modal fade" id="myModel{{$driver->user->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de chauffeur: <strong>{{$driver->user->firstname}}</strong> wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteDriver/{{$driver->user->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder chauffeur</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach