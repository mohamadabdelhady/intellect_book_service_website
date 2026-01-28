@extends('Dashboard.components.layout')
@section('content')
    <div id="app">
        <get_authors :authors="{{ json_encode($authors) }}" :query="{{ json_encode($query) }}" ></get_authors>
    </div>
@endsection