<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/update-photo', [UserController::class, 'updatePhoto'])->name('user.update-photo');
    Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::post('/reviews/update', [ReviewController::class, 'update'])->name('reviews.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/user/auth', [UserController::class, 'auth'])->name('user.auth');
    Route::post('/user/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/password-recovery', [UserController::class, 'passwordRecovery'])->name('password.request');
    Route::post('/user/password-recovery', [UserController::class, 'passwordRecoverySendEmail'])->name('password.email');
    Route::get('/user/reset-password/{token}', [UserController::class, 'resetPassword'])->name('password.reset');
    Route::post('/user/reset-password', [UserController::class, 'resetPasswordStore'])->name('password.reset.store');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show')->where('id', '[0-9]+')->middleware('only.ajax');
