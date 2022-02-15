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
<nav class="navbar" id="nav-bar">
    <div class="container-fluid">
        <a href="/"><div class="navbar-brand" id="logo-img"></div></a>
    </div>
</nav>
<div class="notification-bar" id="notification">
    <i class="fas fa-exclamation-circle"></i><span id="notification-message"></span>
</div>
<div class="sign-up-form card ml-auto mr-auto">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div id="logo-img"class="ml-auto mr-auto mb-2" ></div>
        <p class="h5 form-group">You have to verify your email address, please check your email for verification link.</p>
        <div class="form-group"><p align="center"><button type="submit" class="btn btn-block btn-log">Resend email</button></p></div>
{{--        <a class="already" href="/login">Already have an account? Log in here.</a>--}}
    </form>
    @if(session('status'))
        <script type="text/javascript">
            document.getElementById('notification').style.display="block";
            document.getElementById("notification-message").innerHTML += "<li><i class='fas fa-exclamation-circle'></i>"+"{{ session('status') }}"+"</li>";
        </script>
    @endif
</div>
</body>
</html>
