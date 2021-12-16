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
Route::get('/settings',[\App\Http\Controllers\Controller::class, 'query'])->middleware('auth');
Route::get('/auth/redirect',[\App\Http\Controllers\SocialmediaAuth::class, 'redirectToGoogle']);
Route::get('/auth/callback', [\App\Http\Controllers\SocialmediaAuth::class, 'handleGoogleCallback']);
Route::get('/load_all_books/{sort}',[\App\Http\Controllers\load_book::class,'get_all_books']);
Route::get('/load_all_audio_books/{sort}',[\App\Http\Controllers\load_book::class,'get_all_audiobooks']);
Route::get('/check_book_{id}',[\App\Http\Controllers\read_book::class,'check_book']);
Route::get('/check_audio_{id}',[\App\Http\Controllers\read_book::class,'check_audio']);
Route::get('/load_all_comments/{id}/{type}',[\App\Http\Controllers\read_book::class,'get_comments']);
Route::post('/post_comment',[\App\Http\Controllers\read_book::class,'post_comment']);
Route::get('/read_{id}',[\App\Http\Controllers\read_book::class,'load_book']);
