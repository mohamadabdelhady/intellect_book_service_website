@extends('Dashboard.components.layout')
@section('content')
<div id="app"><edit_category :category="{{ json_encode($category) }}"></edit_category></div>
@endsection