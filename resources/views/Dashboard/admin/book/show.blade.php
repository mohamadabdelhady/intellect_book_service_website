@extends('Dashboard.components.layout')
@section('content')
<div id="app"><view_book :book="{{ json_encode($book) }}"></view_book></div>
@endsection