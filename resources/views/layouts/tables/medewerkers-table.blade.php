<div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>E-mail</th>
            <th>Telefoonnummer</th>
            <th>Profiel foto</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->firstname}} </td>
                <td>{{$admin->lastname}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->phone_number}}</td>
                <td>
                @if($admin->profile_photo == "")
                    <img src="../assets/img/avatars/avatar.png" alt="Profiel foto" height="42" width="42">
                @else
                    <img src="../{{$admin->profile_photo}}" alt="Profiel foto" height="42" width="42">
                @endif
                </td>
                <td width="12%" class="text-right">
                    <a class="btn btn-sm green-meadow" href="/medewerkerwijzigen/{{$admin->id}}"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-sm red-sunglo deleteButton" data-model-id="{{$admin->id}}" data-toggle="modal" href="#myModel{{$admin->id}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@foreach($admins as $comm)
    @if($comm)
    <div class="modal fade" id="myModel{{$comm->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de medewerker {{$comm->firstname .' '. $comm->lastname}} wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteAdmin/{{$comm->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder medewerker</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    @endif
@endforeach