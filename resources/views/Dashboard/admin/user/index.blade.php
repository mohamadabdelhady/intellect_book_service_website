@extends('Dashboard.components.layout')
@section('content')
<div id="app"><get_users :users="{{ json_encode($users) }}" :query="{{ json_encode($query) }}"></get_users></div>
@endsection