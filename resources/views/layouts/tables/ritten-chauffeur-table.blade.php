 <table class="table table-hover">
         <thead>
             <th>Kenteken</th>
             <th>Chauffeur</th>
             <th>Start tijd</th>
             <th>Start locatie</th>
             <th>Eind locatie</th>
             <th>Laatst gezien</th>
         </thead>
         <tbody>
             @foreach($routes as $route)
                @if($route->taxi && $route->taxi->driver)
                @if($route->taxi->driver->user_id == Auth::user()->id)
                     <tr>
                         @if($route->taxi && $route->taxi->driver)
                             <td>{{$route->taxi->license_plate}}</td>
                             <td>{{$route->taxi->driver->user->firstname .' '. $route->taxi->driver->user->lastname}}</td>
                         @else
                         <td>Geen taxi gekoppeld</td>
                         <td>Geen chauffeur gekoppeld</td>
                         @endif

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
                         @if($route->taxi)
                         <td>@if($route->taxi->in_shift == 1)<i class="fa fa-circle" style="color: #41f800;" ></i>
                             @else<i class="fa fa-circle" style="color: #F85200;" ></i> <small>@endif @if($route->taxi->last_seen != '0000-00-00 00:00:00') {{date('d-m-Y H:i',strtotime($route->taxi->last_seen))}} @else Geen @endif</small>
                         </td>
                         @else
                         <td>Geen taxi gekoppeld</td>
                         @endif
                     </tr>
                     @endif
                     @endif
             @endforeach
         </tbody>
     </table>
