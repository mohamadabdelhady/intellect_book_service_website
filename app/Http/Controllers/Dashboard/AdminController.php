<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('Dashboard.admin.index');
    }

    public function create()
    {
        return view('Dashboard.admin.create');
    }

    public function store()
    {

    }

    public function show(Admin $admin)
    {
        return view('Dashboard.admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('Dashboard.admin.edit', compact('admin'));
    }
    public function update(Request $request, Admin $admin)
    {

    }
    public function destroy(Admin $admin)
    {
        
    }
}
