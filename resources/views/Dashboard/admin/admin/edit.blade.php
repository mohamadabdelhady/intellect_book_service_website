@extends('Dashboard.components.layout')
@section('content')
    <div id="app">
        <edit_admin :admin="{{ json_encode($admin) }}"></edit_admin>
    </div>
@endsection