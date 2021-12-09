<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
@include('pages.nav-bar')
<div class="container">
<div class="row"style="padding-top: 100px">

    <div class="col-12"><load_book></load_book>
        <br>
    <load_audiobooks></load_audiobooks>
    </div>
</div>

    <div class="mt-5 ml-3"><hr>all copyright reserved for intellect book service&copy; 2021</div>
</div>
</body>
</html>
