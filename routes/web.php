<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Auth::routes(); 

Route::get('/', [HomeController::class, 'index'])->name('home');

//User
Route::get('/user/hapus/{id}', [UserController::class, 'destroy']);
Route::resource('/user', UserController::class);



