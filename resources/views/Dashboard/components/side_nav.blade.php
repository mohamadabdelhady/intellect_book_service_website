<?php
use App\Enums\AdminRole;
?>
<div class="side-nav-links" id="side-nav-links">
    <a href="{{ route('admin.dashboard') }}" class="side-nav-link">Dashboard</a>
    @if (auth('admin')->check() && auth('admin')->user()->hasRole(AdminRole::ADMIN_SUPER))
    <a href="{{ route('admin.admins.index') }}" class="side-nav-link">Admins</a>
    <a href="{{ route('admin.users.index') }}" class="side-nav-link">Users</a>
    @endif
    <a href="{{ route('admin.books.index') }}" class="side-nav-link">Books</a>
    <a href="{{ route('admin.authors.index') }}" class="side-nav-link">Authors</a>
    <a href="{{ route('admin.categories.index') }}" class="side-nav-link">Categories</a>
</div>