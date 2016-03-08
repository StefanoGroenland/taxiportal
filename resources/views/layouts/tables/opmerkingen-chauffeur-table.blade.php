<table class="table table-hover" >
      <thead>
          <th>Kenteken</th>
          <th>Chauffeur</th>
          <th>Beoordeling</th>
          <th>Opmerking</th>
          <th>Opmerking geplaatst op</th>
      </thead>
      <tbody>
         @foreach($commentsApproved as $comment)
            @if($comment && $comment->driver)
                @if($comment->driver->user_id == Auth::user()->id && $comment->approved > 0)
                <tr>
                    @if($comment->taxi)
                    <td>{{$comment->driver->taxi->license_plate}}</td>
                    @else
                    <td>Geen taxi gekoppeld</td>
                    @endif
                    <td>{{$comment->driver->user->firstname .' '. $comment->driver->user->surname .' '. $comment->driver->user->lastname}}</td>
                    <td>
                        @for($i = 0; $i < $comment->star_rating; $i++)
                            <i style="color:gold;" class="fa fa-star"></i>
                        @endfor
                    </td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->created_at->format('d-m-Y H:i')}}</td>
                </tr>
                @endif
            @endif
         @endforeach
      </tbody>
  </table>

