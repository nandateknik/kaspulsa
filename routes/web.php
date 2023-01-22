<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ReportTransaksiController;
use App\Http\Controllers\ReportTransaksiBulananController;
use App\Http\Controllers\ReportSaldoAkhirController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [AuthController::class,'index'])->name('login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('/login', [AuthController::class,'postLogin']);

Route::group(['middleware' => 'auth'], function(){
    Route::GET('/',[HomeController::class,'index']);
    Route::GET('home',[HomeController::class,'index']);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('bank', BankController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::POST('transaksi/set-kas-awal',[TransaksiController::class,'setKasAwal']);
    Route::GET('report/transaksi/per-tanggal',[ReportTransaksiController::class,'index']);
    Route::GET('report/transaksi/per-bulan',[ReportTransaksiBulananController::class,'index']);
    Route::GET('report/saldo-akhir',[ReportSaldoAkhirController::class,'index']);
});
