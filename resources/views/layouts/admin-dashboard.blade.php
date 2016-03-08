<div class="page-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/taxilocatie">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Aantal taxi's</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-yellow-lemon fa fa-taxi"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Nu actief</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countCars}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/ritten">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Aantal ritten</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green-seagreen fa fa-map-marker"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Vandaag ingepland</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$routeCount}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/ritten/openstaand">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Openstaande ritten</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-blue fa fa-calendar-plus-o"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Nog te koppelen</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countOpenRoutes}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/opmerkingen">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Opmerkingen</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green-turquoise fa fa-comments-o"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Actie vereist op</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countComments}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <div id="map" style="height: 500px; width: 100%;" class="contact_maps md-shadow-z-2"></div>
                    </div>
                    </div>
                </div>
