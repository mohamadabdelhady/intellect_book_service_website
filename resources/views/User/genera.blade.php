@extends('User.components.layout')
@section('content')
        <div class="genera-banner h1"><p>{{$genera->name}}</p></div>
        @if ($genera->banner_img!==null)
        <img class="genera-image" src="/storage/{{ $genera->banner_img }}">
        @endif
            <div id="app">
           <get_books_by_genera :genera="{{ json_encode($genera) }}"></get_books_by_genera>
           <br>
           <get_audio_books_by_genera :genera="{{ json_encode($genera) }}"></get_audio_books_by_genera>
           </div>
@endsection