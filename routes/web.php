<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProdukController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('bank', BankController::class);
Route::resource('produk', ProdukController::class);
Route::resource('transaksi', TransaksiController::class);
Route::POST('transaksi/set-kas-awal',[TransaksiController::class,'setKasAwal']);
