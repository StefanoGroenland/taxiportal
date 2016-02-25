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
 	                                            <a href="/auth/logout">
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

 	                                <li class="dropdown dropdown-fw @if(\Request::route()->getName() == 'home') active open selected @endif">
 	                                    <a href="/home" class="text-uppercase">
 	                                        <i class="fa fa-home"></i> Dashboard
 	                                    </a>
 	                                </li>
 	                                <li class="dropdown more-dropdown @if(\Request::route()->getName() == 'taxilocatie' ||
 	                                                                      \Request::route()->getName() == 'taxioverzicht' ||
 	                                                                      \Request::route()->getName() == 'taxiwijzigen' ||
 	                                                                      \Request::route()->getName() == 'taxitoevoegen') active selected @endif" >
 	                                    <a href="/taxilocatie" class="text-uppercase">
 	                                        <i class="fa fa-briefcase" ></i> Taxi's
 	                                    </a>
 	                                    <ul class="dropdown-menu taxi_dropdown">
 	                                        <li>
 	                                            <a href="/taxioverzicht">Overzicht</a>
 	                                        </li>
 	                                    </ul>
 	                                </li>

 	                                <li class="dropdown dropdown-fw  @if(\Request::route()->getName() == 'ritten' ||
                                                                         \Request::route()->getName() == 'ritwijzigen' ||
                                                                         \Request::route()->getName() == 'rittoevoegen') active open selected @endif">
 	                                    <a href="/ritten" class="text-uppercase">
 	                                        <i class="fa fa-location-arrow"></i> Ritten
 	                                    </a>
 	                                </li>
 	                                <li class="dropdown dropdown-fw  @if(\Request::route()->getName() == 'opmerkingen') active open selected @endif">
 	                                    <a href="/opmerkingen" class="text-uppercase">
 	                                        <i class="fa fa-comments-o"></i> Opmerkingen
 	                                    </a>
 	                                </li>
 	                                <li class="dropdown more-dropdown @if(\Request::route()->getName() == 'reclames' ||
 	                                                                      \Request::route()->getName() == 'chauffeurs' ||
 	                                                                      \Request::route()->getName() == 'tablets' ||
 	                                                                      \Request::route()->getName() == 'medewerkers' ) active selected @endif">
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