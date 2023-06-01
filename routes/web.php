<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/coba', function () {
    return view('index');
});
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('actionregister', [LoginController::class, 'actionregister'])->name('actionregister');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');