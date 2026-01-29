@extends('Dashboard.components.layout')
@section('content')
<div id="app"><view_category :category="{{ json_encode($category) }}"></view_category></div>
@endsection