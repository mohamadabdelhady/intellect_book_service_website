<nav class="navbar" id="nav-bar">
    <div class="container-fluid" style="justify-content: normal; margin-left: 10px;">
       <a href="#" onclick="event.preventDefault(); openNav()"> <img src="/images/menu.png" style="width: 30px;height: 40px; margin-left: 0; margin-right: 10px;"></a>
        <a href="/"><div class="navbar-brand" id="logo-img"></div></a>
        <div>
            <form class="navbar-nav ml-auto mr-auto" id="Search-form" >
                <input class="form-control " type="search" placeholder="Search" aria-label="Search" id="search-input" name="q">
            </form>
        </div>
{{--        <div class="dropdown">--}}

{{--            <button class="main-menu dropdown-toggle mr-3 " type="button" id="userlogindrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                @if(auth()->user()->profile_img)--}}
{{--                    <img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" id="userAvatar">--}}
{{--                @else--}}
{{--                    <img src="/images/user_default.png" id="userAvatar">--}}
{{--                @endif--}}
{{--                    <span--}}
{{--                        class="ml-3">{{auth()->user()->name}}</span>--}}

{{--            </button>--}}
{{--            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}

{{--                <a class="dropdown-item" href="{{route('settings')}}"onclick="event.preventDefault(); document.getElementById('settings').submit();"><img src="/settings.png" id="user_icons"> <span class="ml-2">settings</span></a>--}}
{{--                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/images/logout_icon.png" id="user_icons"> <span class="ml-2">log out</span></a>--}}
{{--                <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">--}}
{{--                    @csrf--}}
{{--                </form>--}}
{{--                <form id="settings" action="{{route('settings')}}" method="post" style="display: none;">--}}
{{--                    @csrf--}}
{{--                </form>--}}


{{--            </div>--}}
{{--        </div>--}}
        <div class="main-menu">
            <a href="" class="main-btn" onclick="event.preventDefault(); view_menu();">
            <div>
                @if(auth()->user()->profile_img)
                <p> <img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" id="userAvatar"><i class="arrow down"></i></p>

                                @else
                    <p>  <img src="/images/user_default.png" id="userAvatar"><i class="arrow down"></i></p>

                                @endif

            </div>
            </a>
            <div class="menu-content" id="menu-content">
                <br>
                <span class="ml-3">{{auth()->user()->name}}<hr></span>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="ml-1">Sign out</span></a>
                                <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                                    @csrf
                                </form>
                <br>
            </div>
        </div>

    </div>
    <div></div>
</nav>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <a href="#">book genera</a>
    <a href="#">audio books</a>
    <a href="#">about us</a>
    <a href="#">Contact us</a>
</div>
<script>
    function view_menu(){

        document.getElementById('menu-content').classList.toggle("show");
    }
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>