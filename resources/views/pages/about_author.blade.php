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
        <div class="col-sm-4 col-5 col-xl-3 col-lg-3 cover">
            <img src="/authors_imges/{{$data->img}}" class="cover_overview">
        </div>
        <div class="col-sm-8 col-7 col-xl-9 col-lg-9">
            <p class="h1">{{$data->name}}</p>
            <hr>
            <p>{{$data->About}}</p>
            <hr>
            <get_author_work :books="{{json_encode($books)}}" :audio="{{json_encode($audio)}}"></get_author_work>
        </div>

    </div>
    @include('pages.footer')
</div>

</body>
</html>
<script>
    import Get_author
    import Get_author
    export default {
        components: {
            Get_author's_work }),
            Get_author's_work })}
        }
</script>
