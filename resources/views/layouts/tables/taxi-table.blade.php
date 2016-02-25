<div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Kenteken</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Kleur</th>
            <th>Chauffeur</th>
            <th>Beoordeling</th>
            <th>Locatie</th>
            <th>Laatst gezien</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($taxis as $taxi)
                @foreach($drivers as $driver)
                    <tr>
                        <td>{{$taxi->license_plate}}</td>
                        <td>{{$taxi->car_brand}}</td>
                        <td>{{$taxi->car_model}}</td>
                        <td>{{$taxi->car_color}}</td>
                        <td>{{$driver->user->firstname .' '. $driver->user->surname .' '. $driver->user->lastname}}</td>
                        <td>
                        @for($i = 0; $i < $driver->star_rating; $i++)
                            <i style="color:gold;" class="fa fa-star"></i>
                        @endfor
                        </td>
                        <td>LOCATIE LAT LONG</td>
                        <td>@if($taxi->in_shift == 1)<i class="fa fa-circle" style="color: #41f800;" ></i>
                            @else<i class="fa fa-circle" style="color: #F85200;" ></i> <small>@endif{{date('d-m-Y H:i',strtotime($taxi->last_seen))}}</small>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>