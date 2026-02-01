<nav class="navbar" id="nav-bar">
    <div class="container-fluid">
        <a href="{{ route('admin.dashboard') }}"><div class="navbar-brand" id="logo-img"></div></a>
        <p class="m-auto admin-p">Admin Dashboard</p>
        @if (Auth::guard('admin')->check())
        <div class="main-menu">
        <a href="" class="main-btn" onclick="event.preventDefault(); view_menu();">
            <p> <img src="{{url('/images/user_default.png/'.auth('admin')->user()->profile_img)}}" id="userAvatar"><i class="arrow down"></i></p>
        </a>
        <div class="menu-content" id="menu-content">
                <br>
                <p class="ml-3"> {{auth('admin')->user()->name}}</p>
                <hr>
                <a class="dropdown-item" href="">Settings</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Log out</a>
                <br>
            </div>
        </div>
        @endif
        </div>
    </div>
</nav>
<script>
    function view_menu() {
       var is= document.getElementById("menu-content").style.display;
       if(is=="block")
           document.getElementById("menu-content").style.display="none";
       else
           document.getElementById("menu-content").style.display="block";
    }
</script>
<style>
    .admin-p{
        color: white;
        font-size: medium;
        transform: rotate(-15deg);
    }
</style>