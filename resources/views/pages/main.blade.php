<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        @if((auth()->user()->first_time)==true)
            window.onload = function() {
            $('#myModal').modal('toggle');
        }
        {{\Illuminate\Support\Facades\DB::table('users')->where('id','=',auth()->user()->id)->update(['first_time'=>false])}}
        @endif
    </script>
</head>
<body>
@include('pages.nav-bar')
<div class="container">
<div class="row" id="main_div">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
                    <p class="txtb">You are now enjoying your 30 days trial, after the trial end you can choose from our affordable plans.</p>
                    <div class="ml-5 mb-2">
                        <div align="center">
                            <div class="container ">
                                <div class="row plans pt-2">
                                    <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3"><p class="display-2">1</p><p style="font-size: large">month</p><p style="font-size: x-large">10 &#36;</p></div>
                                    <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3"><p class="display-2">6</p><p style="font-size: large">month</p><p style="font-size: x-large">45 &#36;</p></div>
                                    <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3"><p class="display-2">1</p><p style="font-size: large">year</p><p style="font-size: x-large">100 &#36;</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn m-auto" data-dismiss="modal">Ok</button>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12"><load_book></load_book>
        <br>
    <load_audiobooks></load_audiobooks>
    </div>
</div>
    @include('pages.footer')
</div>
</body>
</html>
