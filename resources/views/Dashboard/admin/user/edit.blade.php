@extends('Dashboard.components.layout')
@section('content')
<div id="app"><edit_user :user="{{ json_encode($user) }}"></edit_user></div>
@endsection