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
            <img src="/authors_imges/{{$data->img}}" class="cover_overview">
        </div>
        <div class="col-8">
            <p class="h1">{{$data->name}}</p>
            <hr>
            <p>{{$data->About}}</p>
            <hr>
        </div>

    </div>
    @include('pages.footer')
</div>

</body>
</html>
