@extends('Dashboard.components.layout')
@section('content')
<div id="app"><view_user :user="{{ json_encode($user) }}"></view_user></div>
@endsection