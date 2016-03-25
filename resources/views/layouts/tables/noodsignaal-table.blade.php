<table class="table table-hover" >
      <thead>
          <th>Kenteken</th>
          <th>Chauffeur</th>
          <th>Laatst gezien</th>
          <th>Gemeld op</th>
          <th></th>
      </thead>
      <tbody>

          @foreach($emergencies as $sos)
          <tr>
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
              <td class="text-right">
                  <a class="btn btn-sm yellow-lemon popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Markeer gezien" href="/seenSignal/{{$sos->id}}"><i class="fa fa-check"></i></a>
              </td>
          </tr>
          @endforeach

      </tbody>
  </table>

