<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @routes
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
@include('User.nav-bar')
<div class="container">
    <div class="row" id="main_div">
<div class="col-sm-4 col-5 col-xl-3 col-lg-3 cover">

    <img src="/books/{{$book->cover_img}}" class="cover_overview">
    <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault(); document.getElementById('read_btn').click();"><i class="fas fa-book-reader fa-2x" style=""></i></button>
    <a href="{{ route('read-or-listen', ['id' => $book->id,'type' => 'book']) }}" style="display: none" id="read_btn"></a>
    @if(!$book->is_bookmarked)

    <button class="btn mt-3" style="width: 100%"><i class="fas fa-bookmark fa-2x" onclick="event.preventDefault(); document.getElementById('bookmark_btn').click();"></i></button>
    <a href="{{ route('add-bookmark', ['id' => $book->id, 'type' => 'book']) }}" style="display: none" id="bookmark_btn" ></a>
    @else
        <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault();document.getElementById('Rbookmark_btn').click();"><img src="https://img.icons8.com/glyph-neue/32/000000/delete-bookmark.png"/></button>
        <a href="{{ route('remove-bookmark', ['id' => $book->id, 'type' => 'book']) }}" style="display: none" id="Rbookmark_btn" ></a>
    @endif
</div>
        <div class="col-sm-8 col-7 col-xl-9 col-lg-9">
            <p class="m-3 h2">{{$book->name}}</p>
            <p class="m-3 h5">by <a href="get/{{$book->author_id}}">{{$book->author_name}}</a></p>
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
    @include('User.footer')
</div>
</body>
</html>
