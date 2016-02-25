<div class="table-responsive">
  <table class="table table-hover" >
      <thead>
          <th>Kenteken</th>
          <th>Chauffeur</th>
          <th>Beoordeling</th>
          <th>Opmerking</th>
          <th>Opmerking geplaatst op</th>
          @if(Auth::user()->user_rank == 'admin')
              <th></th>
          @endif
      </thead>
      <tbody>
      @foreach($comments as $comment)
          <tr>
              <td>{{$comment->driver->taxi->license_plate}}</td>
              <td>{{$comment->driver->user->firstname .' '. $comment->driver->user->surname .' '. $comment->driver->user->lastname}}</td>
              <td>
                  @for($i = 0; $i < $comment->driver->star_rating; $i++)
                      <i style="color:gold;" class="fa fa-star"></i>
                  @endfor
              </td>
              <td>{{$comment->comment}}</td>
              <td>{{$comment->created_at->format('d-m-Y H:i')}}</td>
              @if(Auth::user()->user_rank == 'admin')
                  <td width="12%" class="text-right">
                      <a class="btn btn-sm green-meadow" href="/opmerkingwijzigen"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                  </td>
              @endif
          </tr>
          @endforeach
      </tbody>
  </table>
</div>