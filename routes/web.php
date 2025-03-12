<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'detail'])->name('news.detail');
