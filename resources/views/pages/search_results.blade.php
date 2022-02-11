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
    <div class="row"style="padding-top: 100px">

        <div class="col-12">
            <search_results :books="{{json_encode($ebooks)}}" :audio="{{json_encode($audio_books)}}" :authors="{{json_encode($authors)}}"></search_results>
        </div>
    </div>
</div>
@include('pages.footer')
</body>
</html>