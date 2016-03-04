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
        
                <tr>
                    <td><strong>{{$taxi->license_plate}}</strong></td>
                    <td>{{$taxi->car_brand}}</td>
                    <td>{{$taxi->car_model}}</td>
                    <td>{{$taxi->car_color}}</td>
                    @if($taxi->driver && $taxi->driver->user)
                    <td>{{$taxi->driver->user->firstname .' '. $taxi->driver->user->surname .' '. $taxi->driver->user->lastname}}</td>
                    @else
                    <td>Geen chauffeur</td>
                    @endif
                    
                    <td>@if($taxi->in_shift == 1)<i class="fa fa-circle" style="color: #41f800;" ></i>
                        @else<i class="fa fa-circle" style="color: #F85200;" ></i> @endif<small>@if($taxi->last_seen !== '0000-00-00 00:00:00') {{date('d-m-Y H:i',strtotime($taxi->last_seen))}} @else Geen @endif</small>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
