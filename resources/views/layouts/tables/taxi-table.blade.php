<div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Kenteken</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Kleur</th>
            <th>Chauffeur</th>
            <th>Beoordeling</th>
            <th>Locatie<small>(latitude, longtitude)</small></th>
            <th>Laatst gezien</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($taxis as $taxi)
                @if($taxi->driver && $taxi->driver->user)
                    <tr>
                        <td>{{$taxi->license_plate}}</td>
                        <td>{{$taxi->car_brand}}</td>
                        <td>{{$taxi->car_model}}</td>
                        <td>{{$taxi->car_color}}</td>
                        <td>{{$taxi->driver->user->firstname .' '. $taxi->driver->user->surname .' '. $taxi->driver->user->lastname}}</td>
                        <td>
                        @for($i = 0; $i < $taxi->driver->star_rating; $i++)
                            <i style="color:gold;" class="fa fa-star"></i>
                        @endfor
                        </td>
                        <td>{{$taxi->last_latitude .' - '. $taxi->last_longtitude}}</td>
                        <td>@if($taxi->in_shift == 1)<i class="fa fa-circle" style="color: #41f800;" ></i>
                            @else<i class="fa fa-circle" style="color: #F85200;" ></i> @endif <small>{{date('d-m-Y H:i',strtotime($taxi->last_seen))}}</small>
                        </td>
                        <td class="text-right">
                                <a class="btn btn-sm green-meadow" href="/taxiwijzigen"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endif
            @endforeach
        </tbody>
    </table>
</div>