<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .notfound{
            background-image: url('/images/404.jpg');
            width: 100%;
            min-height: 90vh;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .four{
            color: #ceac64;
            font-size: 35vh;
        }
        .found{
            color: #ceac64;
            font-size: 10vh;
        }
        .home{
            width: 50vh;
            background-color: #e1cfa9;
            color: #050000;
        }

        .block{
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;

        }
    </style>
</head>
<body>
<nav class="navbar" id="nav-bar">
    <div class="container-fluid">
        <div class="navbar-brand" id="logo-img"></div>
    </div>
</nav>
<div class="notfound">
    <div class="block">
        <p align="center" class="four">404</p>
        <p align="center" class="found">PAGE NOT FOUND</p>
        <p align="center"><button class="btn home" onclick="window.location.href='/';">Go Home</button></p>
    </div>
</div>
</body>
</html>
