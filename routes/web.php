<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return view('pages.main');}
    else
    {
        return view('auth.home');
    }
});
Route::get('/subscribe', function () {
    if (Auth::check()) {
        return view('pages.main');}
    else {
        return view('auth.subscribe');
    }
});
Route::get('/login-form', function () {
    if (Auth::check()) {
        return view('pages.main');}
    else {
        return view('auth.login');
    }
});
Route::get('/main', function () {
    return view('pages.main');
});
