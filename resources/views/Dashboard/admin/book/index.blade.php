@extends('Dashboard.components.layout')
@section('content')
<div id="app"><get_books :books="{{ json_encode($books) }}"></get_books></div>
@endsection