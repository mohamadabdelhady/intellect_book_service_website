<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        return view('auth.subscribe');

});
Route::get('/login-form', function () {

        return view('auth.login');
});
Route::get('/auth/redirect',[\App\Http\Controllers\SocialmediaAuth::class, 'redirectToGoogle']);
Route::get('/auth/callback', [\App\Http\Controllers\SocialmediaAuth::class, 'handleGoogleCallback']);
