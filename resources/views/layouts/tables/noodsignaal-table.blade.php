<div class="table-responsive">
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
          <tr>
              <td>{{$sos->taxi->license_plate}}</td>
              <td>{{$sos->taxi->driver->user->firstname}}</td>
              <td>{{date('d-m-Y H:i:s',strtotime($sos->taxi->last_seen))}}</td>
              <td>{{$sos->created_at->format('d-m-Y H:i:s')}}</td>
              <td>@if($sos->seen == 1) <i class="fa fa-check" ></i> @else <i class="fa fa-times"></i> @endif</td>
              <td class="pull-right text-right">
                  <a class="btn btn-sm green-meadow" href="/seenSignal/{{$sos->id}}"><i class="fa fa-check"></i></a>
              </td>
          </tr>
          @endforeach

      </tbody>
  </table>
</div>

<a class="btn btn-info collapsed" role="button" data-toggle="collapse" href="#validated" aria-expanded="false" aria-controls="collapseValidated">
  <i class="fa fa-archive"> </i> Verwerkte noodsignalen bekijken
</a>

<div class="table-responsive collapse" id="validated" >
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
                @foreach($emergenciesSeen as $sos)
                <tr>
                    <td>{{$sos->taxi->license_plate}}</td>
                    <td>{{$sos->taxi->driver->user->firstname}}</td>
                    <td>{{date('d-m-Y H:i:s',strtotime($sos->taxi->last_seen))}}</td>
                    <td>{{$sos->created_at->format('d-m-Y H:i:s')}}</td>
                    <td>@if($sos->seen == 1) <i class="fa fa-check" ></i> @else <i class="fa fa-times"></i> @endif</td>
                    <td class="pull-right text-right">
                        <a class="btn btn-sm green-meadow" href="/seenSignal/{{$sos->id}}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
  </table>
</div>