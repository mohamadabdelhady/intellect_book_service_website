<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('Dashboard.admin.dashboard');
    }
}
