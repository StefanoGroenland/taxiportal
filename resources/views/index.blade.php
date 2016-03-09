@extends('layouts.master')


@section('content')
     @if(Auth::user()->user_rank == 'admin')
        @include('layouts.admin-dashboard')
     @else
        @include('layouts.driver-dashboard')
     @endif
@endsection

@include('layouts.car-location-maps')

