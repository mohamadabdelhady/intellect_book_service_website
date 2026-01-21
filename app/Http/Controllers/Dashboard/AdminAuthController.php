<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Dashboard.auth.login');
    }

    public function login(Request $request)
    {
       $credentials=$request->validate([
        'email'=>'required|email',
        'password'=>'required|min:6'
       ]);

       if(Auth::guard('admin')->attempt($credentials))
        {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email'=>'Invalid Credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
