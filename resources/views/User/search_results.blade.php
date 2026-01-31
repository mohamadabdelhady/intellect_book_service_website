@extends('User.components.layout')
@section('content')
<div class="container">
    <div class="row" id="main_div">

        <div class="col-12">
            <div id="app">
            <search_results :books="{{json_encode($books)}}" :audio="{{json_encode($audiobooks)}}" :authors="{{json_encode($authors)}}"></search_results>
            </div>
        </div>
    </div>
</div>
@endsection
