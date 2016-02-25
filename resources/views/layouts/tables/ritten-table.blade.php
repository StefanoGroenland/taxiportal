 <div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Kenteken</th>
            <th>Chauffeur</th>
            <th>Start tijd</th>
            <th>Start locatie</th>
            <th>Eind locatie</th>
            <th>Laatst gezien</th>
            @if(Auth::user()->user_rank == 'admin')
                <th></th>
            @endif
        </thead>
        <tbody>
            @foreach($routes as $route)
                @foreach($drivers as $driver)
                    @if($route->taxi)
                    <tr>
                        <td>{{$route->taxi->license_plate}}</td>
                        <td>{{$driver->user->firstname .' '. $driver->user->surname .' '. $driver->user->lastname}}</td>
                        <td>{{date('d-m-Y H:i',strtotime($route->pickup_time))}}</td>
                        <td>
                            {{$route->start_street .' '.
                            $route->start_number.', '.
                            $route->start_zip .' '. $route->start_city}}
                        </td>
                        <td>
                            {{$route->end_street .' '.
                            $route->end_number.', '.
                            $route->end_zip .' '. $route->end_city}}
                        </td>
                        <td>@if($route->taxi->in_shift == 1)<i class="fa fa-circle" style="color: #41f800;" ></i>
                            @else<i class="fa fa-circle" style="color: #F85200;" ></i> <small>@endif{{date('d-m-Y H:i',strtotime($route->taxi->last_seen))}}</small></td>
                        <td class="text-right">
                        @if(Auth::user()->user_rank == 'admin')
                                <a class="btn btn-sm green-meadow" href="/ritwijzigen"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                        @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
 </div>