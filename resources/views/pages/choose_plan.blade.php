<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<div class="notification-bar" style="display: block;" id="notification">
    <i class="fas fa-exclamation-circle"></i><span id="notification-message">sorry, your trial has ended, but if you wish to continue using this website you can choose one of our following plan plans.</span>
</div>
<div style="margin-top: 100px; min-height: 60vh">
    <div class="ml-5 mb-2">

        <div align="center">
            <h1 class="">Choose your plan</h1>
            <div class="container ">
                <div class="row plans pt-2">
                    <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3" onclick="window.location.href='choose/planA';" style="cursor: pointer;"><p class="display-2">1</p><p style="font-size: large">month</p><p style="font-size: x-large">10 &#36;</p></div>
                    <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3" onclick="window.location.href='choose/planB';" style="cursor: pointer;"><p class="display-2">6</p><p style="font-size: large">month</p><p style="font-size: x-large">45 &#36;</p></div>
                    <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3" onclick="window.location.href='choose/planC';" style="cursor: pointer;"><p class="display-2">1</p><p style="font-size: large">year</p><p style="font-size: x-large">100 &#36;</p></div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="mt-5 ml-3">All copyright reserved for intellect book service&copy; 2022</div>
</body>
</html>
