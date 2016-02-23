 <div class="table-responsive">
    <table class="table table-hover" >
        <thead>
            <th>Kenteken</th>
            <th>Chauffeur</th>
            <th>Start tijd</th>
            <th>Start locatie</th>
            <th>Eind locatie</th>
            <th>Laatst gezien</th>
            @if(Auth::user()->user_rank == 'admin')
                <th></th>
            @endif
        </thead>
        <tbody>
            <tr>
                <td>06-ZGD-0</td>
                <td>Richard Perdaan</td>
                <td>13:25 19-2-2016</td>
                <td>Rotterdam</td>
                <td>Amsterdam</td>
                <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                @if(Auth::user()->user_rank == 'admin')
                    <td width="12%" class="text-right">
                        <a class="btn btn-sm green-meadow" href="/ritwijzigen"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                    </td>
                @endif
            </tr>
             <tr>
                <td>06-ZGD-0</td>
                <td>Richard Perdaan</td>
                <td>13:25 19-2-2016</td>
                <td>Rotterdam</td>
                <td>Amsterdam</td>
                <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
                @if(Auth::user()->user_rank == 'admin')
                    <td width="12%" class="text-right">
                        <a class="btn btn-sm green-meadow" href="/ritwijzigen"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm red-sunglo" href="#"><i class="fa fa-trash"></i></a>
                    </td>
                @endif
            </tr>
             <tr>
                <td>06-ZGD-0</td>
                <td>Richard Perdaan</td>
                <td>13:25 19-2-2016</td>
                <td>Rotterdam</td>
                <td>Amsterdam</td>
                <td><i class="fa fa-circle" style="color: #41f800;" ></i> <small>15:19 18-02-2016</small></td>
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