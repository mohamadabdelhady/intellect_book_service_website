<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DashBoardAuthController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function addNewAdmin()
    {
        return view('dashboard.auth.add_admin');
    }
}