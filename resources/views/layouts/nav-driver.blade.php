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
 	                                        <span>Hallo, {{Auth::user()->firstname}}</span>
 	                                        <img src="{{URL::asset('../assets/img/avatar1.jpg')}}" alt=""> </button>
 	                                    <ul class="dropdown-menu-v2" role="menu">
 	                                        <li>
 	                                            <a href="/profiel">
 	                                                <i class="icon-user"></i> Mijn profiel
 	                                                @if(count(\App\Comment::where('seen','!=',1)->get()) > 0)
                                                        <span class="badge badge-danger"> {{count(\App\Comment::where('seen','!=',1)->get())}} </span>
                                                    @endif
 	                                            </a>
 	                                        </li>
 	                                        <li class="divider"> </li>

 	                                        <li>
 	                                            <a href="/logout">
 	                                                <i class="icon-key"></i> Uitloggen </a>
 	                                        </li>
 	                                    </ul>
 	                                </div>
 	                            </div>
 	                        </div>
 	                        <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
 	                         <a id="index" class="page-logo" href="index.html">
 	                               <img src="{{URL::asset('../assets/img/taxi_logo.png')}}" alt="Logo"> </a>
 	                            <ul class="nav navbar-nav">
 	                                <li class="dropdown dropdown-fw  active open selected">
 	                                    <a href="/home" class="text-uppercase">
 	                                        <i class="fa fa-home"></i> Dashboard
 	                                    </a>
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
 	                            </ul>
 	                        </div>
 	                    </div>
 	                </nav>
 	            </header>