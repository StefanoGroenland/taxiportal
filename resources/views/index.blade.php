@extends('layouts.master')


@section('content')
	<div class="page-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="/taxioverzicht">
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
                         <a href="/ritten">
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <h4 class="widget-thumb-heading">Openstaande ritten</h4>
                                <div class="widget-thumb-wrap">
                                    <i class="widget-thumb-icon bg-green fa fa-folder-open-o"></i>
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
                                    <i class="widget-thumb-icon bg-blue-chambray fa fa-comments-o"></i>
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Actie vereist op</span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$countComments}}">0</span>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </div>
                    </div>
                </div>    
                
@endsection

@section('scripts')
	    <script src="{{URL::asset('../assets/js/jquery.waypoints.min.js')}}" type="text/javascript"></script>
	    <script src="{{URL::asset('../assets/js/jquery.counterup.min.js')}}" type="text/javascript"></script>
@endsection

