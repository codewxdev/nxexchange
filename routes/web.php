<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::get('/register',[RegisterController::class, 'ShowRegister'])->name('register.index');
Route::post('/register-store',[RegisterController::class, 'storeRegisterForm'])->name('register.store');
Route::post('/send-code', [RegisterController::class, 'sendCode'])->name('send.code');


Route::post('/login-store',[LoginController::class, 'StoreLoginForm'])->name('login.store');
Route::get('/login',[LoginController::class, 'ShowLogin'])->name('login.index');



Route::get('password/reset', [ForgetPasswordContoller::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgetPasswordContoller::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ForgetPasswordContoller::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgetPasswordContoller::class, 'reset'])->name('password.update');