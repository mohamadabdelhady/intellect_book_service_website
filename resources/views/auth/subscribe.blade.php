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

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input name="name" class="form-control @error('name') is-invalid @enderror" id="uname-input" placeholder="Name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" placeholder="Email" name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password-input" placeholder="Password" autocomplete="on">
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="confirm-password-input" placeholder="Confirm password" name="password_confirmation" autocomplete="on">
        </div>
        <div class="form-group" align="center">

            <button type="submit" class="btn">Sign up</button>

        </div>
        <a class="already" href="login">Already have an account? Log in here.</a>
    </form>

    <hr style="background-color: #e1cfa9">
    <div align="center">
        <p style="font-size: large">Or sign up with</p>
        <a href="/auth/redirect"><img class="signup-icon" src="/images/gmail-icon.png"></a>
    </div>
</div>
<div class="mt-5 ml-3">All copyright reserved for intellect book service&copy; 2021</div>
</body>
</html>
