

    <table class="table table-bordered table-hover" id="sample_1">
        <thead>
            <th>Chauffeur</th>
            <th>Kenteken</th>
            <th>Email</th>
            <th>Telefoonnummer</th>
            <th>Geslacht</th>
            <th>Gemiddelde beoordeling</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($drivers as $driver)
            @if($driver && $driver->user && $driver->comment)
                    <tr data-href="/chauffeurwijzigen/{{$driver->user->id}}">
                        <td>{{$driver->user->firstname .' '. $driver->user->surname .' '. $driver->user->lastname}}</td>
                        <td>
                        @if($driver->taxi)
                        {{$driver->taxi->license_plate}}
                        @else
                        Geen taxi koppeling
                        @endif
                        </td>
                        <td>{{$driver->user->email}}</td>
                        <td>{{$driver->user->phone_number}}</td>
                        <td>{{$driver->user->sex}}</td>
                        <td>
                            {{-- */$stars = 0;/* --}}
                            {{-- */$rowCount = 0;/* --}}
                            {{-- */$avg = 0;/* --}}
                            @foreach($driver->comment as $key => $value)
                                @if($value->approved > 0)
                                    {{-- */$stars += $value->star_rating;/* --}}
                                    {{-- */$rowCount += count($value->star_rating);/* --}}
                                @endif
                            @endforeach
                            @if($stars > 0)
                            {{-- */$avg = $stars / $rowCount;/* --}}
                            @else
                            Geen beoordeling
                            @endif

                            @for($i = 0;$i < $avg; $i++)
                                <i style="color:gold;" class="fa fa-star"></i>
                            @endfor
                        </td>
                        <td width="12%" class="text-right">
                            <a class="btn btn-sm blue popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Chauffeur wijzigen" href="/chauffeurwijzigen/{{$driver->user->id}}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm red-sunglo deleteButton popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Chauffeur verwijderen" data-model-id="{{$driver->user->id}}" data-toggle="modal" href="#myModel{{$driver->user->id}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
            @endif
        @endforeach
        </tbody>
        </table>





@foreach($drivers as $driver)
    @if($driver && $driver->user)
    <div class="modal fade" id="myModel{{$driver->user->id}}" tabindex="-1"  aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Verwijder verzoek</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u de chauffeur: <strong>{{$driver->user->firstname}}</strong> wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                    <form method="POST" action="/deleteDriver/{{$driver->user->id}}" >
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger pull-right">Verwijder chauffeur</button>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
    @endif
@endforeach