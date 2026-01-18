<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function dashboardSettings()
    {
        return view('dashboard.settings.index');
    }

    public function dashboardProfile()
    {
        return view('dashboard.profile.index');
    }

    public function dashboardAnalytics()
    {
        return view('dashboard.analytics.index');
    }

}
