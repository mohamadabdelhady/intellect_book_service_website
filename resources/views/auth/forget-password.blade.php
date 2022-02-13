<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body >
<nav class="navbar" id="nav-bar">
    <div class="container-fluid">
        <a href="/"><div class="navbar-brand" id="logo-img"></div></a>
    </div>
</nav>

<div class="sign-up-form card ml-auto mr-auto">
    <form method="POST" action="{{ route('password.request') }}">
        @csrf
        <div id="logo-img"class="ml-auto mr-auto mb-2" ></div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail"  placeholder="Email" name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group"><p align="center"><button class="btn btn-block btn-log" type="submit">Reset password</button></p></div><a class="already" href="/login">You already have an account? Log in here.</a>
    </form>
</div>
</body>
</html>
