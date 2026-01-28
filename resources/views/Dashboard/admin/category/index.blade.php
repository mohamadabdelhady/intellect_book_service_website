@extends('Dashboard.components.layout')
@section('content')
<div id="app"><get_categories :categories="{{ json_encode($categories) }}" :query="{{ json_encode($query) }}"></get_categories></div>
@endsection