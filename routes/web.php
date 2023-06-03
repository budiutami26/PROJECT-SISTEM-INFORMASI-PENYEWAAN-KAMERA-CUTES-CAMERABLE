<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; //memanggil file login controller
use App\Http\Controllers\RegisterController; //memanggil file register controller

//Route itu berfungsi untuk menjalankan file blade di browser

Route::get('/coba', function () {
    return view('index');
});
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('actionregister', [LoginController::class, 'actionregister'])->name('actionregister');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');