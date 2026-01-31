@extends('User.components.layout')
@section('content')
<div class="container">
    <div class="row" id="main_div">

        <div class="col-12">
           
            <div id="app">
            <user_bookmark :books="{{json_encode($books)}}" :audiobooks="{{json_encode($audiobooks)}}" :user_name="{{json_encode(auth()->user()->name)}}"></user_bookmark>
            </div>
        </div>
    </div>
</div>
@endsection
