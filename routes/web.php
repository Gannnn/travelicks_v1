<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->as('app.')->group(function()
{
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('register', RegisterController::class)->name('register');
});

Route::get('/', HomeController::class)->name('home');

Route::resource('/listing', ListingController::class)->only(['index', 'store', 'show']);
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->name('listings.destroy');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/listings', [DashboardController::class, 'listings'])->name('dashboard.listings');
Route::get('/dashboard/reservations', [DashboardController::class, 'reservations'])->name('dashboard.reservations');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard/listings', [AdminDashboardController::class, 'index'])->name('admin.dashboard.listings');
    Route::get('/admin/dashboard/listings/data', [AdminDashboardController::class, 'data'])->name('admin.dashboard.listings.data');
});

Route::prefix('auth')->group(function()
{
    Route::get('redirect/{driver}', [LoginController::class, 'handlerRedirect'])->name('login.redirect');
    Route::get('callback/{driver}', [LoginController::class, 'handlerCallback'])->name('login.callback');
});

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');
Route::get('/comments/{listingId}', [CommentController::class, 'index']);

Route::resource('/reservation', ReservationController::class)->only(['store']);

Route::fallback(function () {
    return redirect()->route('home');
});
