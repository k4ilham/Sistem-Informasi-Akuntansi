<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;


Auth::routes(); 

Route::get('/', [HomeController::class, 'index'])->name('home');

//User
Route::get('/user/hapus/{id}', [UserController::class, 'destroy']);
Route::resource('/user', UserController::class);

//Barang
Route::get('/barang/hapus/{id}', [BarangController::class, 'destroy']);
Route::resource('/barang', BarangController::class);



