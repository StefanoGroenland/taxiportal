<div class="table-responsive">
    <table class="table table-hover" >
        <thead>
        <th><small> Kenteken</small></th>
        <th><i class="fa fa-taxi" ></i><small> Merk</small></th>
        <th><small> Model</small></th>
        <th><small> Kleur</small></th>
        <th><i class="fa fa-user"></i><small> Chauffeur</small></th>
        <th><i class="fa fa-wifi" ></i><small> Laatste gezien</small></th>
        </thead>
        <tbody>
        @foreach($taxis as $taxi)
            @foreach($drivers as $driver)
                <tr>
                    <td><strong>{{$taxi->license_plate}}</strong></td>
                    <td>{{$taxi->car_brand}}</td>
                    <td>{{$taxi->car_model}}</td>
                    <td>{{$taxi->car_color}}</td>
                    <td>{{$driver->user->firstname .' '. $driver->user->surname .' '. $driver->user->lastname}}</td>
                    <td>@if($taxi->in_shift == 1)<i class="fa fa-circle" style="color: #41f800;" ></i>
                        @else<i class="fa fa-circle" style="color: #F85200;" ></i> <small>@endif{{date('d-m-Y H:i',strtotime($taxi->last_seen))}}</small>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>