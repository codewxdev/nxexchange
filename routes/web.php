<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\ForgetPasswordContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

// use function Pest\Laravel\get;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/trade', [TradeController::class, 'index'])->name('trade.index');
Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
Route::get('/market', [MarketController::class, 'index'])->name('market.index');
Route::get('/help', [HelpController::class, 'index'])->name('help.index');
Route::get('/transactions', [WalletController::class, 'transaction'])->name('transaction.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/help/terms', [HelpController::class, 'terms'])->name('help.terms');
Route::get('/help/privacy', [HelpController::class, 'privacy'])->name('help.privacy');
Route::get('/help/financial', [HelpController::class, 'financial'])->name('help.financial');

Route::get('/register', [RegisterController::class, 'ShowRegister'])->name('register.index');
Route::post('/register-store', [RegisterController::class, 'storeRegisterForm'])->name('register.store');
Route::post('/send-code', [RegisterController::class, 'sendCode'])->name('send.code');

Route::post('/login-store', [LoginController::class, 'StoreLoginForm'])->name('login.store');
Route::get('/login', [LoginController::class, 'ShowLogin'])->name('login.index');
Route::get('password/reset', [ForgetPasswordContoller::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgetPasswordContoller::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ForgetPasswordContoller::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgetPasswordContoller::class, 'reset'])->name('password.update');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// dashboard route start here
Route::middleware('isAdmin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::prefix('admin')->group(function () {
        Route::resource('signals', SignalController::class)->names('admin.signals');
    });

    Route::get('deposit', [DepositController::class, 'index'])->name('deposits.index');
    // Route::post('/deposits/store', [DepositController::class, 'store'])->name('deposits.store');
    Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraws.index');
    // Route::post('/withdrawals/store', [WithdrawController::class, 'store'])->name('withdrawals.store');
    Route::get('transfer', [TransferController::class, 'index'])->name('transfers.index');
    // Route::post('/transfers/store', [TransferController::class, 'store'])->name('transfers.store');
    Route::post('/deposits/{deposit}/update-status', [DepositController::class, 'updateStatus'])->name('deposits.updateStatus');
    Route::post('/withdraws/{withdraw}/update-status', [WithdrawController::class, 'updateStatus'])->name('withdraws.updateStatus');
});


Route::post('/trade/execute', [TradeController::class, 'executeTrade'])->name('trade.execute');

Route::get('/crypto', [CryptoController::class, 'index'])->name('crypto.index');
Route::get('/crypto-data', [CryptoController::class, 'fetchData'])->name('crypto.data');


Route::post('/wallet/address/store', [WalletController::class, 'store'])->name('wallet.address.store');

Route::post('/deposit/ipn', [DepositController::class, 'ipn'])->name('deposits.ipn');
// User Deposit Create (form → store)
Route::post('/deposit/store', [DepositController::class, 'store'])->name('deposits.store');
// Deposit invoice/payment page
Route::get('/deposit/{deposit}', [DepositController::class, 'show'])->name('deposits.show');
 

// KYC
// Route::get('/kyc',[KycController::class, 'index'])->name('kyc.index');
Route::get('/identity-verification',[KycController::class, 'index'])->name('kyc.index');
Route::post('/kyc-store',[KycController::class, 'store'])->name('kyc.store');
 

Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])
    ->name('notification.delete');
