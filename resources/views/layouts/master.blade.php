<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	        <meta charset="utf-8" />
	        <title>TaxiPanel</title>
	        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	        <meta content="width=device-width, initial-scale=1" name="viewport" />
	        <meta content="" name="description" />
	        <meta content="" name="author" />
	        <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
	        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
	        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
	        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	        <link href="{{URL::asset('../assets/css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
	        <link href="{{URL::asset('../assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	        <link href="{{URL::asset('../assets/css/uniform.default.min.css')}}" rel="stylesheet" type="text/css" />       
	        <link href="{{URL::asset('../assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
	        <link href="{{URL::asset('../assets/css/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    			<link href="{{URL::asset('../assets/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    			<link href="{{URL::asset('../assets/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
    			<link href="{{URL::asset('../assets/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
	        <link href="{{URL::asset('../assets/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    			<link href="{{URL::asset('../assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    			
    			<link rel="stylesheet" href="{{URL::asset('../assets/css/morris-0.4.3.min.css')}}">
          <link rel="stylesheet" href="{{URL::asset('../assets/css/bootstrap-datetimepicker.min.css')}}">
	        <link href="{{URL::asset('../assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
	        <link rel="shortcut icon" href="../assets/img/favicon.ico" /> 
          <link href="{{URL::asset('../assets/css/jquery.Jcrop.css')}}" rel="stylesheet" type="text/css" />

	</head>
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-md">
	        <!-- BEGIN CONTAINER -->
	        <div class="wrapper">
	            <!-- BEGIN HEADER -->
	            {{--nav layout here--}}
	            @if(Auth::user()->user_rank == "admin")
	            {{--link nav-admin--}}
                @include('layouts.nav-admin')
	            @else
	            {{--link chauffeur--}}
	            @include('layouts.nav-driver')
	            @endif

	    <div class="container-fluid">
	    	@yield('content')
	    </div>
	    
	    <p class="copyright">2016 © Moodles.</p>
	    <a href="#index" class="go2top">
	        <i class="icon-arrow-up"></i>
	    </a>



            <div class="modal fade" id="myModel" tabindex="-1"  aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Noodsignalen</h4>
                        </div>
                        <div class="modal-body">
                        <span class="center-block text-center"><br><i style="color:#e63d4a" class="fa fa-exclamation-triangle fa-4x"></i> </span>
                            <p>Onderstaande tabel toont alle noodmeldingen
                               Mocht een taxi geen locatie verstuurd te hebben in de afgelopen 20 minuten komt deze hier ook te staan.
                            </p>

                            <div class="">
                                <table class="table table-bordered" >
                                    <thead>
                                        <th>Kenteken</th>
                                        <th>Chauffeur</th>
                                        <th>Laatst gezien</th>
                                        <th>Gemeld op</th>
                                    </thead>
                                    @foreach(\App\Emergency::where('seen','!=',1)->get() as $sos)
                                        @if($sos && $sos->taxi)
                                            <tr>
                                                <td>{{$sos->taxi->license_plate}}</td>
                                                @if($sos->taxi->driver)
                                                <td>{{$sos->taxi->driver->user->firstname}}</td>
                                                @endif
                                                @if($sos->taxi->last_seen != '0000-00-00 00:00:00')
                                                <td>{{date('d-m-Y H:i:s',strtotime($sos->taxi->last_seen))}}</td>
                                                @else
                                                <td>Geen data</td>
                                                @endif
                                                <td>{{$sos->created_at->format('d-m-Y H:i:s')}}</td>
                                            </tr>
                                        @endif
                                @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sluiten</button>
                            <a href="/noodsignalen" class="btn btn-danger pull-right">Overzicht</a>
                        </div>
                    </div>
                <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
            </div>

		<script src="{{URL::asset('../assets/js/jquery.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
	    <script src="{{URl::asset('../assets/js/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.blockui.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.uniform.min.js')}}" type="text/javascript"></script>
	    
		<script src="{{URL::asset('../assets/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

	    <script src="{{URL::asset('../assets/js/bootstrap-fileinput.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.sparkline.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/app.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/profile.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/layout.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.Jcrop.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.color.js')}}" type="text/javascript"></script>
       

        <script src="{{URL::asset('../assets/js/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/datatables/datatables.bootstrap.js')}}" type="text/javascript"></script>

        <script src="{{URL::asset('../assets/js/jquery.geocomplete.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/logger.js')}}" type="text/javascript"></script>

        <script src="{{URL::asset('../assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/morris-0.4.3.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/amcharts/amcharts.js') }}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/amcharts/serial.js') }}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/amcharts/lang/nl.js') }}" type="text/javascript"></script>

       <script type="text/javascript">

       $('table').dataTable( {
                "order": [[ 0, "desc" ]],
                           "oLanguage" : {
                               "sInfo" : "Toon _START_ tot _END_ van _TOTAL_ rijen" ,
                               "sInfoEmpty" : "" ,
                               "sInfoEmptyTable" : "Geen resultaten gevonden" ,
                               "sInfoFiltered" : "(Gezocht in _MAX_ rijen)" ,
                               "sZeroRecords" : "Geen resultaten gevonden",
                               "sLengthMenu" : "Toon _MENU_ rijen",
                               "sSearch" : "Zoek : ",
                                   "oPaginate" : {
                                       "sNext" : "Volgende",
                                       "sPrevious" : "Vorige"
                                   }
                           }
                           });

       </script>
       {{-- TODO uncomment for production --}}
       {{--<script type="text/javascript">--}}

        {{--myFunction();--}}
       {{--function myFunction() {--}}
       {{--$.get('http://taxiportaal.dev/api/v1/signalcheck', function(data){--}}
                   {{--}).done(function() {--}}
                   	{{--console.log("signal check done")--}}
                   {{--});--}}

       {{--$.get('http://taxiportaal.dev/api/v1/emergencies', function(data){--}}
              	{{--var sos = jQuery.parseJSON(data);--}}
              	{{--if(sos.length > 0){--}}
              	    {{--$('#myModel').modal('show');--}}
              	{{--}--}}

              {{--}).done(function() {--}}
              	{{--console.log("emergency check done");--}}
              {{--});--}}


       {{--}setInterval(function(){myFunction()}, 300000);--}}

       {{--</script>--}}
        <script type="text/javascript">
           $(document).ready(function() {
                 $('table').on("click",'tr[data-href]',  function() {
                    window.location.href = $(this).data('href');
                });
                $('.deleteButton').on("click", function(event) {
                    var modalId = $(this).data('model-id');
                    event.stopPropagation();
                    $('#myModel'+modalId).modal('show');
                });
           });
        </script>

	    @yield('scripts')       
</body>

</html>