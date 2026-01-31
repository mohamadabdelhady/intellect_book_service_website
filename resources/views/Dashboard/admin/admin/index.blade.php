@extends('Dashboard.components.layout')
@section('content')
    <div id="app">
        <get_admins :admins="{{ json_encode($admins) }}" :query="'{{ $query }}'"></get_admins>
    </div>
@endsection