<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::resource('kategori', KategoriController::class);
Route::resource('produk', ProdukController::class);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
    })->name('logout');