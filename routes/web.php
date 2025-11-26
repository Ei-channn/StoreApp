<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Admin group: resource routes for managing kategori & produk
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
});

// Public/user page
Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('detail/{id}', [UserController::class, 'show'])->name('user.detail');

// Auth routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.perform');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.perform');

Route::get('keranjang', [KeranjangController::class, 'index'])->name('user.keranjang');
Route::post('keranjang/add', [KeranjangController::class, 'add'])->name('user.keranjang.add');
Route::post('keranjang/remove/{id}', [KeranjangController::class, 'remove'])->name('user.keranjang.remove');
Route::post('keranjang/checkout', [KeranjangController::class, 'checkout'])->name('user.keranjang.checkout');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');