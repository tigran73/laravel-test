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

Route::get('/account', [AccountController::class, 'index'])->name('account')->middleware('auth');;
