<!DOCTYPE html>
<html>
    @include('Dashboard.components.header')

<body>
    <header>
    @include('Dashboard.components.navbar')
    </header>

    <!-- MAIN LAYOUT -->
    <div class="d-flex min-vh-100">

        <!-- PAGE CONTENT -->
        <main class="flex-grow-1 p-4 overflow-auto main-content">
            @yield('content')
        </main>

        <!-- SIDE NAV (RIGHT) -->
        <aside class="admin-side-nav" style="width:260px">
            @include('Dashboard.components.side_nav')
        </aside>

    </div>

</body>
</html>
