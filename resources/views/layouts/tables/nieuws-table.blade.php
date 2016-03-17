  <table class="table table-hover" >
      <thead>
          <th>Naam</th>
          <th>Link</th>
          <th>Toegevoegd op</th>
              <th></th>
      </thead>
      <tbody>
          @foreach($news as $rss)
          <tr data-href="/nieuwswijzigen/{{$rss->id}}">
              <td>{{$rss->name}}</td>
              <td>{!! $rss->link !!}</td>
              <td>{{$rss->created_at->format('d-m-Y H:i')}}</td>
                  <td width="12%" class="text-right">
                      <a class="btn btn-sm blue popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Nieuws wijzigen" href="/nieuwswijzigen/{{$rss->id}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm red-sunglo deleteButton popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Nieuws verwijderen" data-model-id="{{$rss->id}}" data-toggle="modal" href="#myModel{{$rss->id}}"><i class="fa fa-trash"></i></a>
                  </td>
          </tr>
          @endforeach
      </tbody>
  </table>
@foreach($news as $rss)
    <div class="modal fade" id="myModel{{$rss->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de nieuwsgroep: <strong>{{$rss->name}}</strong> wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteNews/{{$rss->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder nieuwsgroep</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach