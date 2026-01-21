<!DOCTYPE html>
<html>
    @include('Dashboard.components.header')
<body>
    @include('Dashboard.components.navbar')

<div class="sign-up-form card ml-auto mr-auto">
<form method="POST" action="{{ route('admin.login.submit') }}">
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
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password-input" placeholder="Password" autocomplete="on">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group" align="center">
        <button type="submit" class="btn">log in</button>
    </div>
    <p class="m-1" ><a href="forgot-password">Forgot your password ? click here to reset it</a></p>
</form>
</div>
</body>
</html>
