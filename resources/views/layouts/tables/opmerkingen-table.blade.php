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
                <tr data-href="/opmerkingwijzigen/{{$comment->id}}">
                    @if($comment->driver->taxi)
                    <td>{{$comment->driver->taxi->license_plate}}</td>
                    @else
                    <td>Geen taxi gekoppeld</td>
                    @endif
                    <td>{{$comment->driver->user->firstname .' '. $comment->driver->user->lastname}}</td>
                    <td>
                        @for($i = 0; $i < $comment->star_rating; $i++)
                            <i style="color:gold;" class="fa fa-star"></i>
                        @endfor
                    </td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->created_at->format('d-m-Y H:i')}}</td>
                        <td width="12%" class="text-right">
                            <a class="btn btn-sm blue popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Opmerking wijzigen" href="/opmerkingwijzigen/{{$comment->id}}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm yellow-lemon popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Opmerking goedkeuren" href="/toggleComment/{{$comment->id}}/0"><i class="fa fa-check"></i></a>
                            <a class="btn btn-sm red-sunglo deleteButton popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Opmerking verwijderen" data-model-id="{{$comment->id}}" data-toggle="modal" href="#myModel{{$comment->id}}"><i class="fa fa-trash"></i></a>
                        </td>
                </tr>
            @endif
         @endforeach
      </tbody>
  </table>


@foreach($comments as $comm)
    @if($comm)
    <div class="modal fade" id="myModel{{$comm->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de opmerking wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteComment/{{$comm->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder opmerking</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    @endif
@endforeach
