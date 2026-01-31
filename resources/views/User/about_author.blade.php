@extends('User.components.layout')
@section('content')
<div class="container">
    <div class="row" id="main_div">
        <div class="col-sm-4 col-5 col-xl-3 col-lg-3 cover">
            <img src="/storage/{{$data->img}}" class="cover_overview">
        </div>
        <div class="col-sm-8 col-7 col-xl-9 col-lg-9">
            <p class="h1">{{$data->name}}</p>
            <hr>
            <p>{{$data->About}}</p>
             </div>

    </div>
    <div class="row">
        <div class="row-12">
            <div id="app">
            <get_author_work :books="{{json_encode($books)}}" :audio="{{json_encode($audio)}}"></get_author_work>
            </div>
        </div>
    </div>
</div>
@endsection
