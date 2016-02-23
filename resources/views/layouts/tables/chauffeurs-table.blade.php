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
        @if($driver->user && $driver->taxi)
                <tr>
                    <td>{{$driver->user->firstname .' '. $driver->user->surname .' '. $driver->user->lastname}}</td>
                    <td>{{$driver->taxi->license_plate}}</td>
                    <td>{{$driver->user->email}}</td>
                    <td>{{$driver->user->phone_number}}</td>
                    <td>{{$driver->user->sex}}</td>
                    <td>
                        @for($i = 0; $i < $driver->star_rating; $i++)
                            <i style="color:gold;" class="fa fa-star"></i>
                        @endfor
                    </td>
                    <td width="12%" class="text-right">
                        <a class="btn btn-sm green-meadow" href="/chauffeurwijzigen"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
        @endif
        @endforeach
        </tbody>
    </table>

</div>