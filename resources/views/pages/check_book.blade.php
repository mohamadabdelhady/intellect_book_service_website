<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
@include('pages.nav-bar')
<div class="container">
    <div class="row" style="padding-top: 100px">
<div class="col-3">
    <img src="/books/{{$book_data->cover_img}}" class="cover_overview">
    <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault(); document.getElementById('read_btn').click();"><i class="fas fa-book-reader fa-2x" style=""></i></button>
    <a href="read_{{$book_data->id}}" style="display: none" id="read_btn"></a>
    @if(!$is_bookmark)

    <button class="btn mt-3" style="width: 100%"><i class="fas fa-bookmark fa-2x" onclick="event.preventDefault(); document.getElementById('bookmark_btn').click();"></i></button>
    <a href="bookmark_{{$book_data->id}}/0" style="display: none" id="bookmark_btn" ></a>
    @else
        <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault();document.getElementById('Rbookmark_btn').click();"><img src="https://img.icons8.com/glyph-neue/32/000000/delete-bookmark.png"/></button>
        <a href="remove_bookmark_{{$book_data->id}}/0" style="display: none" id="Rbookmark_btn" ></a>
    @endif
</div>
        <div class="col-8">
            <p class="m-3 h2">{{$book_data->name}}</p>
            <p class="m-3 h5">by <a href="get_{{$book_data->author}}">{{$book_data->author}}</a></p>
            <generate_stars :rating="{{$book_data->rating}}" class="m-3"></generate_stars>
            <hr>
            <p class="h4">Description</p>
            <p class="m-3" style="min-height: 37vh">{{$book_data->text}}</p>
            <hr>
            <reviews_section :type="0":id="{{$book_data->id}}":user_id="{{json_encode(auth()->user()->id)}}"></reviews_section>
        </div>

    </div>
    @include('pages.footer')
</div>

</body>
</html>
