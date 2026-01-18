<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\BooksController;
use App\Http\Controllers\User\GeneraController;
use App\Http\Controllers\User\ReviewsController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\UserBookProgress;

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
Route::get('/', [AuthController::class, 'index']);
Route::get('/subscribe',[AuthController::class, 'register'])->name('register-form');
Route::get('/login',[AuthController::class, 'login'])->name('login')->name('login-form');
Route::get('/auth/redirect',[AuthController::class, 'redirectToGoogle'])->name('google-auth-redirect');
Route::get('/auth/callback', [AuthController::class, 'handleGoogleCallback'])->name('google-auth-callback');

Route::get('/test',[Controller::class,'test'])->name('test');

//routes that do require authentication and verification and subscription
Route::group(['middleware' => ['auth','verified','subscribed']], function () {
    //main pages routes
    Route::get('/home',  [HomeController::class,'index'])->name('home');
    Route::get('/about',[HomeController::class,'getAboutus'])->name('about-us');
    Route::get('/contact',[HomeController::class,'getContact'])->name('contact-us');
    //books routes
    Route::get('/load_all_books/{sort}/{type}',[BooksController::class,'index'])->name('get-all-books');
    Route::get('/check_book_{id}',[BooksController::class,'show'])->name('check-book');
    Route::get('/read/{id}/{type}',[BooksController::class,'readOrListen'])->name('read-or-listen');
    Route::post('/search-results',[BooksController::class,'search'])->name("search-results");
    Route::get('/get/{author}',[BooksController::class,'getAuthor'])->name('get-author');
    //book reviews routes
    Route::get('/load_all_reviews/{id}',[ReviewsController::class,'index'])->name('get-all-reviews');
    Route::post('/post_review',[ReviewsController::class,'post'])->name('post-review');
    Route::post('/edit_review',[ReviewsController::class,'update'])->name('edit-review');
    Route::get('/get_my_review/{id}',[ReviewsController::class,'show'])->name('get-my-review');
    Route::get('/delete_review/{id}',[ReviewsController::class,'destroy'])->name('delete-review');
    //book progress routes
    Route::post('/set_book_progress',[UserBookProgress::class,'create'])->name('set-book-progress');
    Route::get('/get_book_progress/{id}/{type}',[UserBookProgress::class,'get'])->name('get-book-progress');
    //bookmark routes
    Route::get('/bookmarks_list',[BookmarkController::class,'index'])->name('user-bookmarks');
     Route::get('/bookmark/{id}/{type}',[BookmarkController::class,'create'])->name('add-bookmark');
    Route::get('/remove_bookmark/{id}/{type}',[BookmarkController::class,'destroy'])->name('remove-bookmark');
    //genera routes
    Route::get('/load_genera_books/{genera}/{sort}/{type}',[GeneraController::class,'getBooksByGenera'])->name('get-genera-books');
    Route::get('/{genera}',[GeneraController::class,'getGenera'])->name('get-genera');
    //settings routes
    Route::get('/settings',[SettingsController::class,'getSettings'])->name('user-settings');
    Route::post('/prof_change',[SettingsController::class,'changeProfileImg'])->name('change-profile-img');
    Route::post('/change_renew_sub',[SettingsController::class,'changeRenewSetting'])->name('change-renew-setting');
});

//Dashboard routes
Route::group(['middleware'=>[],'prefix'=>'dashboard'], function () {

});

