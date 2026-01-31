@extends('User.components.layout')
@section('content')
<div class="container">
    <div  id="main_div">
        <div id="app">
        <user_settings :route_update_info="{{json_encode(route('user-profile-information.update'))}}" :route_update_password="{{json_encode(route('user-password.update'))}}" :profile_img="{{json_encode(auth()->user()->profile_img)}}" :is0auth="{{json_encode($is0auth)}}" :user_name="{{json_encode(auth()->user()->name)}}"
        :user_email="{{json_encode(auth()->user()->email)}}" :days="{{now()->diffInDays(\Carbon\Carbon::parse(\auth()->user()->created_at))}}" :plan="{{json_encode(auth()->user()->chosen_plan)}}" :is_renew="{{json_encode(auth()->user()->auto_renew_sub)}}"></user_settings>
        </div>
        </div>
    @if($errors->any())
        <script type="text/javascript">
            document.getElementById('notification').style.display="block";

            @foreach ($errors->all() as $error)
            $('#main_div').css('padding-top', function (index, curValue) {
                return parseInt(curValue, 10) + 2 + 'px';
            });
            document.getElementById("notification-message").innerHTML += "<li><i class='fas fa-exclamation-circle'></i>"+"{{ $error }}"+"</li>";
            @endforeach
        </script>
    @endif
</div>
@endsection