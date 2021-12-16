<nav class="navbar" id="nav-bar">
    <div class="container-fluid" style="justify-content: normal; margin-left: 10px;">
       <a href="#" onclick="event.preventDefault(); openNav()"> <img src="/images/menu.png" style="width: 30px;height: 40px; margin-left: 0; margin-right: 10px;"></a>
        <a href="/"><div class="navbar-brand" id="logo-img"></div></a>
        <div class="m-auto">
            <form class="navbar-nav"  >
                <input class="form-control " type="search" placeholder="Search" aria-label="Search" id="search-input">
            </form>
        </div>
        <div class="main-menu">
            <a href="" class="main-btn" onclick="event.preventDefault(); view_menu();">
            <div>
                @if(auth()->user()->profile_img&&auth()->user()->google_id)
                    <p> <img src="{{url(auth()->user()->profile_img)}}" id="userAvatar"><i class="arrow down"></i></p>
                @elseif(auth()->user()->profile_img)
                <p> <img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" id="userAvatar"><i class="arrow down"></i></p>
                                @endif

            </div>
            </a>
            <div class="menu-content" id="menu-content">
                <br>
                <span class="ml-3">{{auth()->user()->name}}<hr></span>
                <a class="dropdown-item" href="#">profile</a>
                <a class="dropdown-item" href="#">Bookmark list</a>
                <a class="dropdown-item" href="settings">Settings</a>
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

    <a href="#"onclick="event.preventDefault(); openGen('genera_b')">books<i class="arrow down" style="border: solid white;border-width: 0 3px 3px 0;"></i></a>
    <div class="books_genera" id="genera_b">
        <a href="">Classics</a>
        <a href="">History</a>
        <a href="">Science</a>
    </div>
    <a href="#"onclick="event.preventDefault(); openGen('genera_a')">audio books<i class="arrow down" style="border: solid white;border-width: 0 3px 3px 0;"></i></a>
    <div class="books_genera" id="genera_a">
        <a href="">Classics</a>
        <a href="">History</a>
        <a href="">Science</a>
    </div>
    <a href="#">about us</a>
    <a href="#">Contact us</a>
</div>
<script>
    function openGen(type) {


       var is= document.getElementById(type).style.display;
       if(is=="none")
       {
           document.getElementById(type).style.display="block";
       }
       else
           document.getElementById(type).style.display="none";
    }

    function view_menu(){

        document.getElementById('menu-content').classList.toggle("show");
    }
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("genera_a").style.display="none";
        document.getElementById("genera_b").style.display="none";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
