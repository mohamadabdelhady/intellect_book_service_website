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

//routes that don't require authentication or verification or subscription
Route::get('/', function () {
    if (Auth::check()) {

        return redirect()->route('home');
    }
    else
    {
        return view('auth.home');
    }
});
Route::get('/subscribe', function () {return view('auth.subscribe');});
Route::get('/login',['as'=>'login','uses'=> function () {return view('auth.login');}]);
Route::get('/query',[\App\Http\Controllers\Controller::class, 'query'])->middleware('auth');
Route::get('/auth/redirect',[\App\Http\Controllers\SocialmediaAuth::class, 'redirectToGoogle']);
Route::get('/auth/callback', [\App\Http\Controllers\SocialmediaAuth::class, 'handleGoogleCallback']);
//routes that do require authentication and verification and subscription
Route::group(['middleware' => ['auth','verified','subscribed']], function () {
    Route::get('/home',  ['as' => 'home', 'uses' => function(){return view('pages.main');}]);
    Route::get('/load_all_books/{sort}',[\App\Http\Controllers\load_book::class,'get_all_books']);
    Route::get('/load_all_audio_books/{sort}',[\App\Http\Controllers\load_book::class,'get_all_audiobooks']);
    Route::get('/check_book_{id}',[\App\Http\Controllers\read_book::class,'check_book']);
    Route::get('/check_audio_{id}',[\App\Http\Controllers\read_book::class,'check_audio']);
    Route::get('/load_all_reviews/{id}/{type}',[\App\Http\Controllers\read_book::class,'get_reviews']);
    Route::post('/post_review',[\App\Http\Controllers\read_book::class,'post_review']);
    Route::post('/edit_review',[\App\Http\Controllers\read_book::class,'update_review']);
    Route::get('/get_my_review/{id}/{type}',[\App\Http\Controllers\read_book::class,'get_my_review']);
    Route::get('/read_{id}',[\App\Http\Controllers\read_book::class,'load_book']);
    Route::get('/delete_review/{id}/{type}',[\App\Http\Controllers\read_book::class,'delete_review']);
    Route::get('/listen_{id}',[\App\Http\Controllers\read_book::class,'load_audio']);
    Route::post('/set_book_progress',[\App\Http\Controllers\ProgressController::class,'set_book_progress']);
    Route::get('/get_book_progress/{id}/{type}',[\App\Http\Controllers\ProgressController::class,'get_book_progress']);
    Route::get('/set_book_progress',[\App\Http\Controllers\ProgressController::class,'set_book_progress']);
    Route::get('/get_{author}',[\App\Http\Controllers\Controller::class,'get_author']);
    Route::get('/bookmark_{id}/{type}',[\App\Http\Controllers\get_books::class,'set_bookmark']);
    Route::get('/remove_bookmark_{id}/{type}',[\App\Http\Controllers\get_books::class,'remove_bookmark']);
    Route::post('/search-results',['as' => 'search-results', 'uses' =>'\App\Http\Controllers\search@search']);
    Route::get('/bookmarks_list',[\App\Http\Controllers\bookmark::class,'get_user_bookmarks']);
    Route::get('/settings',[\App\Http\Controllers\Controller::class,'get_settings']);
    Route::get('/load_genera_books/{genera}/{sort}',[\App\Http\Controllers\genera::class,'get_all_books']);
    Route::get('/load_genera_audio/{genera}/{sort}',[\App\Http\Controllers\genera::class,'get_all_audiobooks']);
    Route::get('/about',[\App\Http\Controllers\Controller::class,'get_aboutus']);
    Route::get('/contact',[\App\Http\Controllers\Controller::class,'get_contact']);
    Route::get('/{genera}',[\App\Http\Controllers\genera::class,'get_genera']);
    Route::post('/prof_change',[\App\Http\Controllers\genera::class,'change_prof']);
});

