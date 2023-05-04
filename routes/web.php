<?php

use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ListPesananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotaPesananController;
use App\Http\Controllers\PenjualDashboardController;
use App\Http\Controllers\PenjualMenuController;
use App\Http\Controllers\PenjualPesananController;
use App\Http\Controllers\PenjualProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('/')->group(function () {
    Route::get('/', [MenuController::class, 'menuView'])->name('menu.view')->middleware('withoutpenjual');

    // authentication
    Route::get('register', [RegisterController::class, 'registerView'])->name('register.view')->middleware('guest');
    Route::post('register-process', [RegisterController::class, 'registerProcess'])->name('register.process');
    Route::get('login', [LoginController::class, 'loginView'])->name('login.view')->middleware('guest');
    Route::post('login-process', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    // end athentication

    // profile pembeli
    Route::get('profile', [ProfileController::class, 'profileView'])->name('profile.view')->middleware('pembeli');
    Route::put('profile-process', [ProfileController::class, 'profileEditProcess'])->name('profile.edit.proccess')->middleware('pembeli');
    // end profile pembeli

    // pemesanan
    Route::post('pemesanan-process', [MenuController::class, 'pemesananProcess'])->name('pemesanan.process');
    Route::post('pemesanan-session', [MenuController::class, 'pemesananSession'])->name('pemesanan.session');
    // end pemesanan

    // search
    Route::get('search', [MenuController::class, 'searchView'])->name('search.view');
    // end search

    // detail-pesanan
    Route::get('detail-pesanan', [DetailPesananController::class, 'detailPesananView'])->name('detail.pesanan.view')->middleware('pembeli');
    Route::post('pemesanan-update-session', [DetailPesananController::class, 'updatePemesananSession'])->name('pemesanan.update.session')->middleware('pembeli');
    Route::delete('delete-pemesanan/{id}', [DetailPesananController::class, 'deletePemesananProcess'])->name('pemesanan.delete.process')->middleware('pembeli');
    Route::post('pemesanan-process-detail', [DetailPesananController::class, 'pesananProcess'])->name('pemesanan.process.detail')->middleware('pembeli');
    // end detail-pesanan

    // nota
    Route::get('nota-pesanan/{id}', [NotaPesananController::class, 'notaView'])->name('nota.pesanan.view')->middleware('pembeli');
    Route::put('kofirmasi-pesanan-pembeli', [NotaPesananController::class, 'konfirmasiPesanan'])->name('pembeli.konfirmasi.pesanan.view')->middleware('pembeli');
    // end nota

    // list pemesanan
    Route::get('list-pesanan', [ListPesananController::class, 'listPesananView'])->name('list.pesanan.view')->middleware('pembeli');

    // end list pemesanan
});

Route::prefix('/penjual')->group(function () {
    // dashboard
    Route::get('dashboard', [PenjualDashboardController::class, 'dashboardView'])->name('dashboard.view')->middleware('penjual');
    Route::get('profile', [PenjualProfileController::class, 'viewProfile'])->name('profile.penjual.view')->middleware('penjual');
    Route::put('edit-profile', [PenjualProfileController::class, 'editProfileProcess'])->name('profile.penjual.edit.process')->middleware('penjual');
    // end dasboard

    // input data penjual
    Route::get('input-data-penjual', [PenjualProfileController::class, 'inputDataPenjual'])->name('input.data.penjual.view')->middleware('inputdatapenjual');
    Route::post('input-data-penjual-process', [PenjualProfileController::class, 'inputDataPenjualProccess'])->name('input.data.penjual.process')->middleware('inputdatapenjual');
    // end input data penjual

    // menu
    Route::get('tambah-menu', [PenjualMenuController::class, 'addMenuView'])->name('menu.add.view')->middleware('penjual');
    Route::post('tambah-menu-process', [PenjualMenuController::class, 'addMenuProcess'])->name('menu.add.process')->middleware('penjual');
    Route::get('data-menu', [PenjualMenuController::class, 'dataMenuView'])->name('menu.data.view')->middleware('penjual');
    Route::get('edit-menu/{id}', [PenjualMenuController::class, 'editMenuView'])->name('menu.edit.view')->middleware('penjual');
    Route::put('edit-menu-process/{id}', [PenjualMenuController::class, 'editMenuProcess'])->name('menu.edit.process')->middleware('penjual');
    Route::delete('delete-menu/{id}', [PenjualMenuController::class, 'deleteMenuProcess'])->name('menu.delete.process')->middleware('penjual');
    // end menu

    // pesanan
    Route::get('pesanan', [PenjualPesananController::class, 'pesananView'])->name('penjual.pesanan.view')->middleware('penjual');
    Route::get('detail-pesanan/{id}', [PenjualPesananController::class, 'pesananDetailView'])->name('penjual.detail.pesanan.view')->middleware('penjual');
    Route::put('kofirmasi-pesanan-penjual', [PenjualPesananController::class, 'konfirmasiPesanan'])->name('penjual.konfirmasi.pesanan.view')->middleware('penjual');
    // endpesanan
});

Route::prefix('/kasir')->group(function () {
    Route::get('pesanan', [KasirController::class, 'kasirView'])->name('kasir.pesanan.view')->middleware('kasir');
    Route::get('detail-pesanan/{id}', [KasirController::class, 'detailPesanan'])->name('kasir.detial.pesanan.view')->middleware('kasir');
    Route::get('search', [KasirController::class, 'kasirSearchView'])->name('kasir.search.view')->middleware('kasir');
    Route::put('konfirmasi-pesanan', [KasirController::class, 'konfirmasiPesanan'])->name('kasir.konfirmasi.pesanan.view')->middleware('kasir');
});
