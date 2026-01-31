<?php

use App\Http\Controllers\Dashboard\AdminAuthController;
use App\Http\Controllers\Dashboard\AdminAuthorController;
use App\Http\Controllers\Dashboard\AdminBookController;
use App\Http\Controllers\Dashboard\AdminCategoryController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\AdminReviewController;
use App\Http\Controllers\Dashboard\AdminUserController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\BooksController;
use App\Http\Controllers\User\GeneraController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ReviewsController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\User\UserBookProgressController;
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

// routes that don't require authentication or verification or subscription
Route::get('/', [AuthController::class, 'index']);
Route::get('/subscribe', [AuthController::class, 'register'])->name('register-form');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/redirect', [AuthController::class, 'redirectToGoogle'])->name('google-auth-redirect');
Route::get('/auth/callback', [AuthController::class, 'handleGoogleCallback'])->name('google-auth-callback');

// routes that do require authentication and verification and subscription
Route::group(['middleware' => ['auth', 'verified', 'subscribed']], function () {
    // main pages routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'getAboutus'])->name('about-us');
    Route::get('/contact', [HomeController::class, 'getContact'])->name('contact-us');
    // books routes
    Route::get('/books/{sort}/{type}', [BooksController::class, 'index'])->name('get-all-books');
    Route::get('/book/{id}', [BooksController::class, 'show'])->name('check-book');
    Route::get('/read/{id}/{type}', [BooksController::class, 'readOrListen'])->name('read-or-listen');
    Route::post('/search', [BooksController::class, 'search'])->name('search-results');
    Route::get('/author/{author}', [BooksController::class, 'getAuthor'])->name('get-author');
    // book reviews routes
    Route::get('/reviews/{id}', [ReviewsController::class, 'index'])->name('get-all-reviews');
    Route::post('/review', [ReviewsController::class, 'post'])->name('post-review');
    Route::post('/review', [ReviewsController::class, 'update'])->name('edit-review');
    Route::get('/review/{id}', [ReviewsController::class, 'show'])->name('get-my-review');
    Route::delete('/review/{id}', [ReviewsController::class, 'destroy'])->name('delete-review');
    // book progress routes
    Route::post('/progress', [UserBookProgressController::class, 'create'])->name('set-book-progress');
    Route::get('/progress/{id}', [UserBookProgressController::class, 'get'])->name('get-book-progress');
    // bookmark routes
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('user-bookmarks');
    Route::get('/bookmark/{id}/{type}', [BookmarkController::class, 'create'])->name('add-bookmark');
    Route::delete('/bookmark/{id}/{type}', [BookmarkController::class, 'destroy'])->name('remove-bookmark');
    // genera routes
    Route::get('/genera-books/{genera}/{sort}/{type}', [GeneraController::class, 'getBooksByGenera'])->name('get-genera-books');
    Route::get('/{genera}/section', [GeneraController::class, 'getGenera'])->name('get-genera');
    // settings routes
    Route::get('/settings', [SettingsController::class, 'getSettings'])->name('user-settings');
    Route::post('/change-profile', [SettingsController::class, 'changeProfileImg'])->name('change-profile-img');
    Route::post('/subscibtion-renew', [SettingsController::class, 'changeRenewSetting'])->name('change-renew-setting');
});

// Dashboard routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth controllers
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Admin management routes
        Route::resource('admins', AdminController::class);
        // Books management routes
        Route::resource('books', AdminBookController::class);
        // Authors management routes
        Route::resource('authors', AdminAuthorController::class);
        // Users management routes
        Route::resource('users', AdminUserController::class);
        // Reviews management routes
        Route::resource('reviews', AdminReviewController::class)->except(['index']);
        Route::get('reviews/book/{book}', [AdminReviewController::class, 'index'])->name('reviews.index');
        // Categories management routes
        Route::resource('categories', AdminCategoryController::class);
    });
});
