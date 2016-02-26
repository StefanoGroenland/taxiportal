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
                        <a class="btn btn-sm green-meadow" href="/tabletwijzigen"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>