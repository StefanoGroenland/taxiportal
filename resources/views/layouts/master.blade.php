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
			
	        <link href="{{URL::asset('../assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
	       
	        <link rel="shortcut icon" href="favicon.ico" /> 

	</head>

	<body class="page-header-fixed page-sidebar-closed-hide-logo page-md">
	        <!-- BEGIN CONTAINER -->
	        <div class="wrapper">
	            <!-- BEGIN HEADER -->
	            <header class="page-header">
	                <nav class="navbar mega-menu" role="navigation">
	                    <div class="container-fluid">
	                        <div class="clearfix navbar-fixed-top">
	                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
	                                <span class="sr-only">Toggle navigation</span>
	                                <span class="toggle-icon">
	                                    <span class="icon-bar"></span>
	                                    <span class="icon-bar"></span>
	                                    <span class="icon-bar"></span>
	                                </span>
	                            </button>
	                            <div class="topbar-actions">
	                                <div class="btn-group-img btn-group">
	                                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	                                        <span>Hi, Marcus</span>
	                                        <img src="{{URL::asset('../assets/img/avatar1.jpg')}}" alt=""> </button>
	                                    <ul class="dropdown-menu-v2" role="menu">
	                                        <li>
	                                            <a href="/profiel">
	                                                <i class="icon-user"></i> Mijn profiel
	                                                <span class="badge badge-danger">1</span>
	                                            </a>
	                                        </li>
	                                        
	                                        <li>
	                                            <a href="noodsignalen">
	                                                <i class="icon-envelope-open"></i> Noodsignalen
	                                                <span class="badge badge-danger"> 3 </span>
	                                            </a>
	                                        </li>
	                                        
	                                        <li class="divider"> </li>
	                                       
	                                        <li>
	                                            <a href="/uitloggen">
	                                                <i class="icon-key"></i> Uitloggen </a>
	                                        </li>
	                                    </ul>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
	                         <a id="index" class="page-logo" href="index.html">
	                               <img src="{{URL::asset('../assets/img/logo.png')}}" alt="Logo"> </a>
	                            <ul class="nav navbar-nav">
	                                <li class="dropdown dropdown-fw  active open selected">
	                                    <a href="/home" class="text-uppercase">
	                                        <i class="fa fa-home"></i> Dashboard
	                                    </a>
	                                </li>
	                                <li class="dropdown more-dropdown">
	                                    <a href="/taxilocatie" class="text-uppercase"> 
	                                        <i class="fa fa-briefcase" ></i> Taxi's
	                                    </a>
	                                    <ul class="dropdown-menu taxi_dropdown">
	                                        <li>
	                                            <a href="/taxioverzicht">Overzicht</a>
	                                        </li>
	                                    </ul>
	                                </li>

	                                <li class="dropdown dropdown-fw  ">
	                                    <a href="/ritten" class="text-uppercase">
	                                        <i class="fa fa-location-arrow"></i> Ritten
	                                    </a>
	                                </li>
	                                <li class="dropdown dropdown-fw  ">
	                                    <a href="/opmerkingen" class="text-uppercase">
	                                        <i class="fa fa-comments-o"></i> Opmerkingen 
	                                    </a>
	                                </li>
	                                <li class="dropdown more-dropdown">
	                                    <a href="#" class="text-uppercase"> 
	                                        <i class="fa fa-briefcase" ></i> Overzichten
	                                    </a>
	                                    <ul class="dropdown-menu">
	                                        <li>
	                                            <a href="/chauffeurs">Chauffeurs</a>
	                                        </li>
	                                        <li>
	                                            <a href="/tablets">Tablets</a>
	                                        </li>
	                                        <li>
	                                            <a href="/medewerkers">Medewerkers</a>
	                                        </li>
	                                         <li>
	                                            <a href="/reclames">Reclames</a>
	                                        </li>
	                                    </ul>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                </nav>
	            </header>
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
        <script src="{{URL::asset('../assets/js/bootstrap-fileinput.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/app.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/profile.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../assets/js/layout.min.js')}}" type="text/javascript"></script>
        
        @yield('scripts')
       
</body>

</html>