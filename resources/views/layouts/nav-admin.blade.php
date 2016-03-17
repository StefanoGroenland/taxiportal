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
 	                                        @if(Auth::user()->profile_photo == "")
                                                <img src="../assets/img/avatars/avatar.png" alt="">
                                            @else
                                                <img src="../{{Auth::user()->profile_photo}}" alt="">
                                            @endif
 	                                    </button>
 	                                    <ul class="dropdown-menu-v2" role="menu">
 	                                        <li>
 	                                            <a href="/profiel">
 	                                                <i class="icon-user"></i> Mijn profiel
 	                                            </a>
 	                                        </li>

 	                                        <li>
 	                                            <a href="/noodsignalen">
 	                                                <i class="icon-envelope-open"></i> Noodsignalen
 	                                                @if(count(\App\Emergency::where('seen','!=',1)->get()) > 0)
 	                                                    <span class="badge badge-danger"> {{count(\App\Emergency::where('seen','!=',1)->get())}} </span>
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
 	                         <a id="index" class="page-logo" href="/home">
 	                               <img src="{{URL::asset('../assets/img/taxi_logo.png')}}" alt="Logo"> </a>
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
                                                <a href="/taxilocatie">Taxi locaties</a>
                                            </li>
 	                                        <li>
 	                                            <a href="/taxioverzicht">Taxi overzicht</a>
 	                                        </li>
 	                                    </ul>
 	                                </li>

 	                                <li class="dropdown more-dropdown  @if(\Request::route()->getName() == 'ritten' ||
                                                                         \Request::route()->getName() == 'ritwijzigen' ||
                                                                         \Request::route()->getName() == 'rittenopenstaand' ||
                                                                         \Request::route()->getName() == 'rittoevoegen') active selected @endif">
 	                                    <a href="/ritten/openstaand" class="text-uppercase">
 	                                        <i class="fa fa-location-arrow"></i> Ritten
 	                                    </a>
 	                                    <ul class="dropdown-menu rit_dropdown">
 	                                        <li>
                                                <a class="rit_anchor" href="/ritten/openstaand">Open ritten</a>
                                            </li>
                                            <li>
                                                <a class="rit_anchor" href="/ritten">Verwerkte ritten</a>
                                            </li>
                                        </ul>

 	                                </li>
 	                                <li class="dropdown more-dropdown  @if(\Request::route()->getName() == 'opmerkingen' ||
 	                                                                      \Request::route()->getName() == 'opmerkingwijzigen' ||
 	                                                                       \Request::route()->getName() == 'opmerkingen-openstaand') active selected @endif">
 	                                    <a href="/opmerkingen/verwerkt" class="text-uppercase">
 	                                        <i class="fa fa-comments-o"></i> Opmerkingen
 	                                    </a>
 	                                    <ul class="dropdown-menu opmerkingen_dropdown">
                                            <li>
                                               <a class="opm_anchor" href="/opmerkingen/verwerkt">Verwerkte opmerkingen</a>
                                            </li>
                                            <li>
                                                <a class="opm_anchor" href="/opmerkingen">Open opmerkingen</a>
                                            </li>
                                        </ul>
 	                                </li>
 	                                <li class="dropdown more-dropdown  @if(\Request::route()->getName() == 'reclames' ||
 	                                                                      \Request::route()->getName() == 'reclametoevoegen' ||
 	                                                                      \Request::route()->getName() == 'reclamewijzigen' ||
 	                                                                      \Request::route()->getName() == 'chauffeurs' ||
 	                                                                      \Request::route()->getName() == 'chauffeurtoevoegen' ||
 	                                                                      \Request::route()->getName() == 'chauffeurwijzigen' ||
 	                                                                      \Request::route()->getName() == 'tablets' ||
 	                                                                      \Request::route()->getName() == 'medewerkers' ||
 	                                                                      \Request::route()->getName() == 'medewerkerwijzigen' ||
 	                                                                      \Request::route()->getName() == 'medewerkertoevoegen' ||
 	                                                                      \Request::route()->getName() == 'tabletwijzigen' ||
 	                                                                      \Request::route()->getName() == 'tablettoevoegen' ||
 	                                                                      \Request::route()->getName() == 'nieuwstoevoegen' ||
 	                                                                      \Request::route()->getName() == 'nieuwswijzigen' ||
 	                                                                      \Request::route()->getName() == 'nieuws' ) active selected @endif">
 	                                    <a href="/reclames" class="text-uppercase ">
 	                                        <i class="fa fa-briefcase" ></i> Overzichten
 	                                    </a>
 	                                    <ul class="dropdown-menu ov_dropdown">
 	                                        <li>
                                         	    <a class="ov_anchor" href="/reclames">Reclames</a>
                                         	</li>
                                         	<li>
                                                <a class="ov_anchor" href="/nieuws">Nieuwsfeeds</a>
                                            </li>
 	                                        <li>
 	                                            <a class="ov_anchor" href="/tablets">Tablets</a>
 	                                        </li>
 	                                        <li>
                                                <a class="ov_anchor" href="/chauffeurs">Chauffeurs</a>
                                            </li>
 	                                        <li>
 	                                            <a class="ov_anchor" href="/medewerkers">Medewerkers</a>
 	                                        </li>


 	                                    </ul>
 	                                </li>
 	                            </ul>
 	                        </div>
 	                    </div>
 	                </nav>
 	            </header>