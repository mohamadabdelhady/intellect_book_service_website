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
        <div style="float: right"><button type="submit" class="btn" onclick="window.location.href='login-form';">login</button></div>
    </div>
</nav>
<div class="jumbotron">
    <h1 class="display-4">Welcome</h1>
    <p class="lead">Intellect is subscription based service for reading books.</p>
    <hr class="my-4">
    <p>Subscribe now and enjoy 30 days free trial.</p>
    <p class="lead">
        <a class="btn btn-lg" style="" href="subscribe" role="button">Subscribe</a>
    </p>
</div>
<div align="center" class="">
    <a href="#"><img src="/images/google-play-icon.png"></a>

</div>
<div class="ml-5">
    <h1 class="display-4">About us</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
<div class="ml-5 mb-2">
    <h1 class="display-4">Subscription plans</h1>
    <div align="center">
        <div class="container ">
            <div class="row plans">
                <div class="col card mr-5 pt-2"><p class="display-2">1</p><p style="font-size: large">month</p><p style="font-size: x-large">10 &#36;</p></div>
                <div class="col card mr-5 pt-2"><p class="display-2">6</p><p style="font-size: large">month</p><p style="font-size: x-large">45 &#36;</p></div>
                <div class="col card pt-2"><p class="display-2">1</p><p style="font-size: large">year</p><p style="font-size: x-large">100 &#36;</p></div>
            </div>
    </div>
</div>
<div class="mt-5 ml-3">all copyright reserved for intellect book service&copy; 2021</div>
</body>
</html>

