@extends('layouts.master')

@section('content')
    <div class="page-content">
    @if (count($errors))
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger"><i class="fa fa-exclamation"></i> {{ $error }}</li>
                 @endforeach
            </ul>
        @endif
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
        <div class="row">
            <div class="col-md-12">
                <div class="profile-sidebar">
                    <div class="portlet light profile-sidebar-portlet bordered">
                        <div class="profile-userpic">
                            @if(Auth::user()->profile_photo == "")
                                <img src="../assets/img/avatars/avatar.png" class="img-responsive" alt=""></div>
                            @else
                                <img src="../{{Auth::user()->profile_photo}}" class="img-responsive" alt=""></div>
                            @endif
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{Auth::user()->firstname .' '. Auth::user()->lastname }} </div>
                            <div class="profile-usertitle-job"> {{Auth::user()->user_rank}} </div>
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
                                            @if($comment->driver)
                                            @if($comment->driver->user_id == Auth::user()->id)
                                            <div class="item">
                                                <div class="item-head">
                                                    <div class="item-details">
                                                        <img class="item-pic" src="{{URL::asset('../assets/img/avatar3.jpg')}}">
                                                        <a href="" class="item-name primary-link">Passagier</a>
                                                        <span class="item-label">{{$comment->created_at->format('d-m-Y H:i')}}</span>
                                                        @if($comment->seen == 0)
                                                        <div class="badge badge-warning">nieuwe reactie</div>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="item-body">{{$comment->comment}}
                                                    @for($i = 0;$i < $comment->star_rating; $i++)
                                                        <i style="color:gold;" class="fa fa-star"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            @endif
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