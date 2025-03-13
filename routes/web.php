<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'index'])->name('news');
Route::get('/news/{id}', [HomeController::class, 'detail'])->name('news.detail');

Route::get('/api/news/{page}/{count}', [HomeController::class, 'newsAjax']);

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'registrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/account', [AccountController::class, 'index'])->name('account')
    ->middleware('auth');

Route::get('/password', [AccountController::class, 'password'])->name('password')
    ->middleware('auth');
Route::post('/change-password', [AccountController::class, 'changePassword'])->name('changePassword')
    ->middleware('auth');

Route::get('/add-news', [AccountController::class, 'addNews'])->name('addNews')
    ->middleware(['role:admin', 'role:content-manager']);
Route::post('/store-news', [AccountController::class, 'storeNews'])->name('storeNews')
    ->middleware(['role:admin', 'role:content-manager']);


Route::get('/admin-panel', [AdminController::class, 'index'])->name('admin')
    ->middleware(['role:admin', 'role:content-manager']);

Route::resource('admin/users', UserController::class)
    ->middleware('role:admin');

Route::resource('admin/news', NewsController::class)
    ->middleware('role:content-manager');

Route::get('/api/admin/news/{page}/{count}', [NewsController::class, 'paginate'])
    ->middleware('role:content-manager');

