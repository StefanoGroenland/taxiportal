<table class="table table-hover" >
      <thead>
          <th>Kenteken</th>
          <th>Chauffeur</th>
          <th>Laatst gezien</th>
          <th>Gemeld op</th>
          <th>Gezien</th>
          <th></th>
      </thead>
      <tbody>

          @foreach($emergencies as $sos)
          <tr data-href="/seenSignal/{{$sos->id}}">
              @if($sos->taxi)
              <td>{{$sos->taxi->license_plate}}</td>
              @else
              <td>Geen taxi gekoppeld</td>
              @endif
              @if($sos->taxi && $sos->taxi->driver)
                <td>{{$sos->taxi->driver->user->firstname}}</td>
              @else
                <td>Geen chauffeur gevonden</td>
              @endif
              @if($sos->taxi)
              <td>{{date('d-m-Y H:i:s',strtotime($sos->taxi->last_seen))}}</td>
              @else
              <td>Geen datum</td>
              @endif
              <td>{{$sos->created_at->format('d-m-Y H:i:s')}}</td>
              <td>@if($sos->seen == 1) <i class="fa fa-check" ></i> @else <i class="fa fa-times"></i> @endif</td>
              <td class="text-right">
                  <a class="btn btn-sm green-meadow" href="/seenSignal/{{$sos->id}}"><i class="fa fa-check"></i></a>
              </td>
          </tr>
          @endforeach

      </tbody>
  </table>

