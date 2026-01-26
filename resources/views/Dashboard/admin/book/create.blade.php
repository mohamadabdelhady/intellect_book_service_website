@extends('Dashboard.components.layout')
@section('content')
<div id="app"><create_book :authors="{{ json_encode($authors) }}" :categories="{{ json_encode($categories) }}"></create_book></div>
@endsection