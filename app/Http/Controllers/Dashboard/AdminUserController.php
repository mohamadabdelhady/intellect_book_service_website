<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('Dashboard.admin.users.index');
    }

    public function create()
    {
        return view('Dashboard.admin.users.create');
    }

    public function store() {}

    public function show(User $user)
    {
        return view('Dashboard.admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('Dashboard.admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {}

    public function destroy(User $user) {}
}
