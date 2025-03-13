<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'detail'])->name('news.detail');

Route::get('/api/news/{page}/{count}', [NewsController::class, 'newsAjax']);

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'registrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/account', [AccountController::class, 'index'])->name('account')->middleware('auth');

Route::get('/password', [AccountController::class, 'password'])->name('password')
    ->middleware('auth');
Route::post('/change-password', [AccountController::class, 'changePassword'])->name('changePassword')
    ->middleware('auth');

Route::get('/add-news', [AccountController::class, 'addNews'])->name('addNews')
    ->middleware('auth');
Route::post('/store-news', [AccountController::class, 'storeNews'])->name('storeNews')
    ->middleware('auth');
