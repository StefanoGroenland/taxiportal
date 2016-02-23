<div class="table-responsive">
     <table class="table table-hover" >
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
                         <a class="btn btn-sm green-meadow" href="/reclamewijzigen"><i class="fa fa-pencil"></i></a>
                         <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
</div>