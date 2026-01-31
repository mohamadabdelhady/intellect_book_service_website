@extends('User.components.layout')
@section('content')
<div class="container">
    <div class="row" id="main_div">
        <div class="genera-banner h1"><p>{{$genera->name}}</p></div>
        <div class="col-12">
            <div id="app">
           <book_genera :genera="{{json_encode($genera->id)}}"></book_genera>
           </div>
        </div>
    </div>
</div>
@endsection