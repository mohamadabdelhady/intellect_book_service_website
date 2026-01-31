@extends('User.components.layout')
@section('content')
<div class="container">
    <div class="" id="main_div">
        <div id="app">
        <listen_audiobook :file_path="{{json_encode($book->file_path)}}" :book_id="{{json_encode($book->id)}}":book_cover="{{json_encode($book->cover_img)}}"></listen_audiobook>
        </div>
    </div>
</div>
@endsection