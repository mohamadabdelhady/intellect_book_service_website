<nav class="navbar" id="nav-bar">
    <div class="container-fluid " style="justify-content: normal; margin-left: 10px;">
       <a href="#" class="menu-btn" onclick="event.preventDefault(); openNav()">
           <div></div>
           <div></div>
           <div></div>
       </a>
        <a href="/"><div class="navbar-brand" id="logo-img"></div></a>
        <div class="m-auto search-bar">
            <form class="navbar-nav" method="post" action="{{route('search-results')}}">@csrf
                <input class="form-control " type="search" placeholder="Search books, audiobooks and authors" aria-label="Search" id="search-input" name="q">
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
                <p class="ml-3"> {{auth()->user()->name}}</p><hr>
                <a class="dropdown-item" href="bookmarks_list">Bookmark list</a>
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
<div class="notification-bar" id="notification">
    <ul><div id="notification-message"></div></ul>
</div>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <br>
    <div class="m-auto" id="nav-small">
        <form class="navbar-nav" method="post" action="{{route('search-results')}}">@csrf
            <input class="form-control " type="search" placeholder="Search books, audiobooks and authors" aria-label="Search" id="" name="q">
        </form>
    </div>
    <a href="#"onclick="event.preventDefault(); openGen('genera_b')">book genera<i class="arrow down" style="border: solid white;border-width: 0 3px 3px 0;"></i></a>
    <div class="books_genera" id="genera_b">
        <a href="Classics">Classics</a>
        <a href="history">History</a>
        <a href="science">Science</a>
    </div>
    <a href="about">about us</a>
    <a href="contact">Contact us</a>
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
    window.onclick = function(event) {
        var $trigger = $(".main-btn");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            document.getElementById("menu-content").classList.remove("show");
        }
    }
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("genera_a").style.display="none";
        document.getElementById("genera_b").style.display="none";
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
