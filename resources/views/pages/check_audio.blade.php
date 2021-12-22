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
            <img src="/audio_books/covers/{{$book_data->cover_img}}" class="cover_overview">
{{--            <button class="btn mt-3" style="width: 100%"><i class="fas fa-headphones-alt fa-2x"></i></button>--}}
            <button class="btn mt-3" style="width: 100%" onclick="event.preventDefault(); document.getElementById('listen_btn').click();"><i class="fas fa-headphones-alt fa-2x" style=""></i></button>
            <a href="listen_{{$book_data->id}}" style="display: none" id="listen_btn"></a>
            <button class="btn mt-3" style="width: 100%"><i class="fas fa-bookmark fa-2x"></i></button>
        </div>
        <div class="col-8">
            <p class="m-3 h2">{{$book_data->name}}</p>
            <p class="m-3 h5">by <a href="#">{{$book_data->author}}</a></p>
            <p class="m-3 h5">narrated by <a href="#">{{$book_data->narrator}}</a></p>
            <generate_stars :rating="{{$book_data->rating}}" class="m-3"></generate_stars>
            <hr>
            <p class="h4">Description</p>
            <p class="m-3" style="min-height: 37vh">{{$book_data->text}}</p>
            <hr>
            <comment_section :profile="{{json_encode(auth()->user()->profile_img)}}":is0auth="{{json_encode(auth()->user()->google_id)}}"
                             :type="1":id="{{$book_data->id}}":user_id="{{json_encode(auth()->user()->id)}}"></comment_section>
        </div>

    </div>
    @include('pages.footer')
</div>

</body>
</html>
