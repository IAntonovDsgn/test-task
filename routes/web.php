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
});

Route::middleware('guest')->group(function () {
    Route::get('/user/auth', [UserController::class, 'auth'])->name('user.auth');
    Route::get('/user/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/user/store/check-email', [UserController::class, 'checkEmail'])->name('user.check-email');
    Route::get('/user/password-recovery', [UserController::class, 'passRecovery'])->name('user.password-recovery');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
