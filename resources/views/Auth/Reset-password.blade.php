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
    <ul><div id="notification-message"></div></ul>
</div>
<div class="sign-up-form card ml-auto mr-auto">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{$request->route('token')}}">
        <div id="logo-img"class="ml-auto mr-auto mb-2" ></div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail"  placeholder="Email" name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="InputPassword" placeholder="Password" name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control  " id="InputConfirmPassword" placeholder="Confirm password" name="password_confirmation">
        </div>
        <div class="form-group"><p align="center"><button class="btn btn-block btn-log" type="submit">Update</button></p></div>
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
