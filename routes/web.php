<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Auth;


Auth::routes(); 

Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::group(['middleware' => ['role:admin']], function () {

        //User
        Route::get('/user/hapus/{id}', [UserController::class, 'destroy']);
        Route::resource('/user', UserController::class);

        //Barang
        Route::get('/barang/hapus/{id}', [BarangController::class, 'destroy']);
        Route::resource('/barang', BarangController::class);

        //Supplier
        Route::get('/supplier/hapus/{id}', [SupplierController::class, 'destroy']);
        Route::resource('/supplier', SupplierController::class);

        //Akun
        Route::get('/akun/hapus/{id}', [AkunController::class, 'destroy']);
        Route::resource('/akun', AkunController::class);
        
    });





