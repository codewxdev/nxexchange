<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SignalController;

// use function Pest\Laravel\get;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/register',[RegisterController::class, 'ShowRegister'])->name('register.index');
Route::post('/register',[RegisterController::class, 'storeRegisterForm'])->name('register.store');
Route::post('/send-code', [RegisterController::class, 'sendCode'])->name('send.code');


Route::get('/login',[LoginController::class, 'ShowLogin'])->name('login.index');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
Route::prefix('admin')->group(function () { 
    Route::resource('signals',SignalController::class)->names('admin.signals');
}); 