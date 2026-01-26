@extends('Dashboard.components.layout')
@section('content')
<div id="app"><edit_book :book="{{ json_encode($book) }}" :authors="{{ json_encode($authors) }}" :categories="{{ json_encode($categories) }}"></edit_book></div>
@endsection