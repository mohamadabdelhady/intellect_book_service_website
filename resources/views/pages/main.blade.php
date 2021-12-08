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
@include('pages.nav-bar')
<div class="container">
<div class="row"style="padding-top: 100px">
  <div class="col-2"></div>
    <div class="col-10"><load_book></load_book></div>
</div>
</div>
</body>
</html>
