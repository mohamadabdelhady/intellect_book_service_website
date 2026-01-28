@extends('Dashboard.components.layout')
@section('content')
    <div id="app">
        <edit_author :author="{{ json_encode($author) }}" ></edit_author>
    </div>
@endsection