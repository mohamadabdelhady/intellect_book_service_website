@extends('Dashboard.components.layout')
@section('content')
    <div id="app">
        <view_admin :admin="{{ json_encode($admin) }}"></view_admin>
    </div>
@endsection