<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'detail'])->name('news.detail');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
