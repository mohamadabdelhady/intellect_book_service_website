<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
@include('pages.nav-bar')


<div class="container">
    <div class="main"style="padding-top: 100px" id="element-id">
{{--        {{dd($errors)}}--}}

        <user_settings :route_update_info="{{json_encode(route('user-profile-information.update'))}}" :route_update_password="{{json_encode(route('user-password.update'))}}" :profile_img="{{json_encode(auth()->user()->profile_img)}}" :is0auth="{{json_encode($is0auth)}}" :user_name="{{json_encode(auth()->user()->name)}}"
        :user_email="{{json_encode(auth()->user()->email)}}"></user_settings>


        </div>
    @if($errors->any())
        <script type="text/javascript">
            document.getElementById('notification').style.display="block";

            @foreach ($errors->all() as $error)
            $('#element-id').css('padding-top', function (index, curValue) {
                return parseInt(curValue, 10) + 2 + 'px';
            });
            document.getElementById("notification-message").innerHTML += "<li><i class='fas fa-exclamation-circle'></i>"+"{{ $error }}"+"</li>";
            @endforeach
        </script>
    @endif
    @include('pages.footer')


</div>


</body>
</html>
