<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $admins = Admin::where('id', '!=', auth('admin')->id())->paginate(10);
        } else {
            $admins = Admin::searchAdmins($query)->paginate(10);
        }

        return view('Dashboard.admin.admin.index', compact('admins', 'query'));
    }

    public function create()
    {
        return view('Dashboard.admin.admin.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin_super,admin_editor',
        ]);

        $admin = Admin::create([
            'name' => $validatedData['name'],
            'profile_img' => $validatedData['photo'] ?? null,
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        return response()->json(['admin' => $admin], 201);
    }

    public function show(Admin $admin)
    {
        return view('Dashboard.admin.admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('Dashboard.admin.admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin_super,admin_editor',
        ]);

        $admin->name = $validatedData['name'];
        if (isset($validatedData['photo'])) {
            $admin->profile_img = $validatedData['photo'];
        }
        $admin->email = $validatedData['email'];
        if (! empty($validatedData['password'])) {
            $admin->password = bcrypt($validatedData['password']);
        }
        $admin->role = $validatedData['role'];
        $admin->save();

        return response()->json(['message' => 'Admin updated successfully', 'admin' => $admin], 200);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
