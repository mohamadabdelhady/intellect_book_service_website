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
<div class="sign-up-form card ml-auto mr-auto">
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" placeholder="Email">
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password-input" placeholder="Password">
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="form-group" align="center">

        <button type="submit" class="btn">log in</button>
    </div>
</form>
    <a class="already" href="subscribe">Dont have an account? sign up here.</a>
    <hr style="background-color: #e1cfa9">
    <div align="center">
        <p style="font-size: large">Or log in with</p>
        <a href="#"><img class="signup-icon" src="/images/gmail-icon.png"></a>
        <a href="#"><img class="signup-icon" src="/images/facebook-icon.png"></a>
    </div>
</div>
<div class="mt-5 ml-3">all copyright reserved for intellect book service&copy; 2021</div>
</body>
</html>
