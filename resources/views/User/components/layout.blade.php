<!DOCTYPE html>
<html>
    @include('User.components.header')

<body>
    <header>
    @include('User.components.navbar')
    </header>

    <!-- MAIN LAYOUT -->
    <div class="d-flex min-vh-100">

        <!-- PAGE CONTENT -->
        <main class="flex-grow-1 p-4 overflow-auto main-content">
            @yield('content')
        </main>

    </div>

</body>
<footer>
    @include('User.components.footer')
</footer>
</html>
