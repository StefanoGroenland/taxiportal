@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-sidebar">
                    <div class="portlet light profile-sidebar-portlet bordered">
                        <div class="profile-userpic">
                            <img src="{{URL::asset('../assets/img/profile_user.jpg')}}" class="img-responsive" alt=""> </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> Marcus Doe </div>
                            <div class="profile-usertitle-job"> Developer </div>
                        </div>
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="active">
                                    <a href="/profiel">
                                        <i class="fa fa-home"></i> Overzicht  
                                    </a>
                                </li>
                                <li>
                                    <a href="/profielwijzigen">
                                        <i class="fa fa-cog"></i> Account instellingen
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Recente opmerkingen</span>
                                        <span class="caption-helper"></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                        <div class="general-item-list">
                                            @foreach($comments as $comment)
                                            @if($comment->driver->id == Auth::user()->id)
                                            <div class="item">
                                                <div class="item-head">
                                                    <div class="item-details">
                                                        <img class="item-pic" src="{{URL::asset('../assets/img/avatar3.jpg')}}">
                                                        <a href="" class="item-name primary-link">Passagier</a>
                                                        <span class="item-label">{{$comment->created_at->format('d-m-Y H:i')}}</span>
                                                    </div>
                                                    <span class="item-status">
                                                        <span class="badge badge-empty badge-success"></span> status</span>
                                                </div>
                                                <div class="item-body">{{$comment->comment}}</div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection