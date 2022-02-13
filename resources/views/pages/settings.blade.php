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
    <div class=""style="padding-top: 100px">

        <user_settings :profile_img="{{json_encode(auth()->user()->profile_img)}}" :is0auth="{{json_encode($is0auth)}}" :user_name="{{json_encode(auth()->user()->name)}}"
        :user_email="{{json_encode(auth()->user()->email)}}"></user_settings>


        </div>
    @include('pages.footer')
</div>


</body>
</html>
