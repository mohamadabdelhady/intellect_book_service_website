@extends('Dashboard.components.layout')
@section('content')
    <div id="app">
        <view_author :author="{{ json_encode($author) }}" ></view_author>
    </div>
@endsection