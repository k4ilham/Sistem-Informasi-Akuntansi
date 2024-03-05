<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailPesanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LapStokController;

Auth::routes(); 

Route::get('/', [HomeController::class, 'index'])->name('home');


//Role ADMIN
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

    //setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/simpan', [SettingController::class, 'simpan']);

});

//Role User & Admin

//Pemesanan
Route::get('/transaksi', [PemesananController::class, 'index'])->name('pemesanan.index');
Route::post('/sem/store', [PemesananController::class, 'store']);
Route::get('/transaksi/hapus/{kd_brg}',[PemesananController::class, 'destroy']); 

//Detail Pesan
Route::post('/detail/store', [DetailPesanController::class, 'store']);
Route::post('/detail/simpan', [DetailPesanController::class, 'simpan']);

//Pembelian
Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/pembelian-beli/{id}', [PembelianController::class, 'edit']);
Route::post('/pembelian/simpan', [PembelianController::class, 'simpan']);

//Cetak Invoice
Route::get('/laporan/faktur/{invoice}', [PembelianController::class, 'pdf'])->name('cetak.order_pdf');

//Retur 
Route::get('/retur',[ReturController::class, 'index'])->name('retur.index');
Route::get('/retur-beli/{id}', [ReturController::class, 'edit']);
Route::post('/retur/simpan', [ReturController::class, 'simpan']);

//Laporan
Route::resource( '/laporan' , LaporanController::class);
Route::get('/laporancetak/cetak_pdf', [LaporanController::class, 'cetak_pdf']);
Route::resource( '/stok' , LapStokController::class);


