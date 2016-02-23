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
          <tr>
              <td>06-ZGD-0</td>
              <td>Richard Perdaan</td>
              <td>
                  <i style="color:gold;" class="fa fa-star"></i>
                  <i style="color:gold;" class="fa fa-star"></i>
                  <i style="color:gold;" class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
              </td>
              <td>Dit is een opmerking :p</td>
              <td>13:26 22-02-2016</td>
              @if(Auth::user()->user_rank == 'admin')
                  <td width="12%" class="text-right">
                      <a class="btn btn-sm green-meadow" href="/ritwijzigen"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                  </td>
              @endif
          </tr>
      </tbody>
  </table>
</div>