<div class="table-responsive">
     <table class="table table-hover data_table" >
         <thead>
             <th>Reclame nummer</th>
             <th>Link</th>
             <th>Locaties</th>
             <th>Aantal kliks</th>
             <th></th>
         </thead>
         <tbody>
             @foreach($ads as $ad)
                 <tr>
                     <td>{{$ad->id}}</td>
                     <td>{{$ad->link}}</td>
                     <td>
                     @foreach($ad->adLocation as $adLoc)
                     {{$adLoc->location}},
                     @endforeach
                     </td>
                     <td>{{$ad->clicks}}</td>
                     <td width="12%" class="text-right">
                         <a class="btn btn-sm green-meadow" href="/reclamewijzigen/{{$ad->id}}"><i class="fa fa-pencil"></i></a>
                         <a class="btn btn-sm red-sunglo deleteButton" data-model-id="{{$ad->id}}" data-toggle="modal" href="#myModel{{$ad->id}}"><i class="fa fa-trash"></i></a>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
</div>
@foreach($ads as $ad)
    <div class="modal fade" id="myModel{{$ad->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modal Title</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de reclame : <strong>{{$ad->link}}</strong> wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteAd/{{$ad->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder reclame</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach


