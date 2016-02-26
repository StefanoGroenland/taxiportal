<div class="table-responsive">
  <table class="table table-hover" >
      <thead>
          <th>Naam</th>
          <th>Link</th>
          <th>Toegevoegd op</th>
              <th></th>
      </thead>
      <tbody>
          <tr>
          @foreach($news as $rss)
              <td>{{$rss->name}}</td>
              <td>{!! $rss->link !!}</td>
              <td>{{$rss->created_at->format('d-m-Y H:i')}}</td>
                  <td width="12%" class="text-right">
                      <a class="btn btn-sm green-meadow" href="/nieuwswijzigen"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                  </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>