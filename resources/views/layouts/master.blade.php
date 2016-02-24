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
	        <link href="{{URL::asset('../assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
	        <link rel="shortcut icon" href="favicon.ico" /> 

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

	    @yield('scripts')       
</body>

</html>