<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('User.main');
    }

    public function getAboutus()
    {
        return view('User.about_us');
    }

    public function getContact()
    {
        return view('User.contact_us');
    }
}
