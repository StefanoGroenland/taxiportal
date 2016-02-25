<div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>E-mail</th>
            <th>Telefoonnummer</th>
            <th>Profiel foto</th>
            @if(Auth::user()->user_rank == 'admin')
            <th></th>
            @endif
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->firstname}} </td>
                <td>{{$admin->surname}}</td>
                <td>{{$admin->lastname}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->phone_number}}</td>
                <td><img src="http://moodles.nl/img/team/team-15.png" alt="Profiel foto" height="42" width="42"></td>
                @if(Auth::user()->user_rank == 'admin')
                <td width="12%" class="text-right">
                    <a class="btn btn-sm green-meadow" href="/medewerkerwijzigen"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>