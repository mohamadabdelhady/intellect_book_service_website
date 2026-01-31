@extends('User.components.layout')
@section('content')
<div class="container">
    <div class="row" id="main_div">
        <div class="col-sm-4 col-4 col-xl-3 col-lg-3 cover">
            <img src="/storage/{{$book->cover_img}}" class="cover_overview">
            <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault(); document.getElementById('listen_btn').click();"><i class="fas fa-headphones-alt fa-2x" style=""></i></button>
            <a href="{{ route('read-or-listen', ['id' => $book->id,'type' => 'audiobook']) }}" style="display: none" id="listen_btn"></a>
            @if(!$book->is_bookmarked)

                <button class="btn mt-3" style="width: 100%"><i class="fas fa-bookmark fa-2x" onclick="event.preventDefault(); document.getElementById('bookmark_btn').click();"></i></button>
                <a href="{{ route('add-bookmark', ['id' => $book->id, 'type' => 'audiobook']) }}" style="display: none" id="bookmark_btn" ></a>
            @else
                <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault();document.getElementById('Rbookmark_btn').click();"><img src="https://img.icons8.com/glyph-neue/32/000000/delete-bookmark.png"/></button>
                <a href="{{ route('remove-bookmark', ['id' => $book->id, 'type' => 'audiobook']) }}" style="display: none" id="Rbookmark_btn" ></a>
            @endif
        </div>
        <div class="col-sm-8 col-8 col-xl-9 col-lg-9">
            <p class="m-3 h2">{{$book->name}}</p>
            <p class="m-3 h5">by <a href="{{ route('get-author', ['author' => $book->author_id]) }}">{{$book->author_name}}</a></p>
            <p class="m-3 h5">narrated by <a>{{$book->narrator}}</a></p>
            <generate_stars :rating="{{$book->rating}}" class="m-3"></generate_stars>
            <hr>
            <p class="h4">Description</p>
            <p class="m-3" style="min-height: 37vh">{{$book->text}}</p>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            <div id="app">
            <reviews_section :id="{{$book->id}}" :user_id="{{json_encode(auth()->user()->id)}}"></reviews_section>
            </div>
    </div>
    </div>
</div>
@endsection
