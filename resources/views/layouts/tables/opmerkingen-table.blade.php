<div class="table-responsive">
  <table class="table table-hover" >
      <thead>
          <th>Kenteken</th>
          <th>Chauffeur</th>
          <th>Beoordeling</th>
          <th>Opmerking</th>
          <th>Opmerking geplaatst op</th>
              <th></th>
      </thead>
      <tbody>
         @foreach($comments as $comment)
            @if($comment && $comment->driver)
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
                        <td width="12%" class="text-right">
                            <a class="btn btn-sm green-meadow" href="/opmerkingwijzigen"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm yellow-lemon" href="/opmerkingwijzigen"><i class="fa fa-check"></i></a>
                            <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                        </td>
                </tr>
            @endif
         @endforeach
      </tbody>
  </table>
</div>

<a class="btn btn-info collapsed" role="button" data-toggle="collapse" href="#validated" aria-expanded="false" aria-controls="collapseValidated">
  <i class="fa fa-archive"> </i> Geaccepteerde feedback bekijken
</a>

<div class="table-responsive collapse" id="validated" >
  <table class="table table-hover" >
      <thead>
          <th>Kenteken</th>
          <th>Chauffeur</th>
          <th>Beoordeling</th>
          <th>Opmerking</th>
          <th>Opmerking geplaatst op</th>
              <th></th>
      </thead>
      <tbody>
        @foreach($commentsApproved as $comment)
            @if($comment && $comment->driver)
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
                        <td width="12%" class="text-right">
                            <a class="btn btn-sm green-meadow" href="/opmerkingwijzigen"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm yellow-lemon" href="/opmerkingwijzigen"><i class="fa fa-check"></i></a>
                            <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                        </td>
                </tr>
            @endif
        @endforeach
      </tbody>
  </table>
</div>