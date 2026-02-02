<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $users = User::where('id', '!=', auth('admin')->id())->paginate(10);
        } else {
            $users = User::searchUsers($query)->paginate(10);
        }

        return view('Dashboard.admin.user.index', compact('users', 'query'));
    }

    public function create()
    {
        return view('Dashboard.admin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'profile_img' => $validatedData['photo'] ?? null,
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function show(User $user)
    {
        return view('Dashboard.admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('Dashboard.admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validatedData['name'];
        if (isset($validatedData['photo'])) {
            $user->profile_img = $validatedData['photo'];
        }
        $user->email = $validatedData['email'];
        if (! empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
