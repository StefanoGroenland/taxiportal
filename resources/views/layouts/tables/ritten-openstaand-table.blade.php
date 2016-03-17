  <table class="table table-hover" >
         <thead>
             <th>Kenteken</th>
             <th>Chauffeur</th>
             <th>Start tijd</th>
             <th>Start locatie</th>
             <th>Eind locatie</th>
             <th>Laatst gezien</th>
                 <th></th>
         </thead>
         <tbody>
             @foreach($routes as $route)

                     <tr data-href="/ritwijzigen/{{$route->id}}">
                         @if($route->taxi && $route->taxi->driver && $route->taxi->driver->user)
                             <td>{{$route->taxi->license_plate}}</td>
                             <td>{{$route->taxi->driver->user->firstname .' '. $route->taxi->driver->user->surname .' '. $route->taxi->driver->user->lastname}}</td>
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
                         <td class="text-right">
                             <a class="btn btn-sm blue popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Rit wijzigen" href="/ritwijzigen/{{$route->id}}"><i class="fa fa-pencil"></i></a>
                             <a class="btn btn-sm yellow-lemon popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Rit status naar verwerkt" href="/toggleRoute/{{$route->id}}/1"><i class="fa fa-check"></i></a>
                             <a class="btn btn-sm red-sunglo deleteButton popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Rit verwijderen" data-model-id="{{$route->id}}" data-toggle="modal" href="#myModel{{$route->id}}"><i class="fa fa-trash"></i></a>
                     </tr>
             @endforeach
         </tbody>
     </table>
 @foreach($routes as $route)
     <div class="modal fade" id="myModel{{$route->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Verwijder verzoek</h4>
                 </div>
                 <div class="modal-body">
                     <p>Weet u zeker dat u de rit: <strong>{{$route->start_city}}</strong> wilt verwijderen?</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                     <form method="POST" action="/deleteRoute/{{$route->id}}" >
                         {!! method_field('DELETE') !!}
                         {!! csrf_field() !!}
                         <button type="submit" class="btn btn-danger pull-right">Verwijder rit</button>
                     </form>
                 </div>
             </div>
         <!-- /.modal-content -->
         </div>
     <!-- /.modal-dialog -->
     </div>
 @endforeach