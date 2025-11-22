<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\ForgetPasswordContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\TradeApprovalController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware(['auth', 'checkUserStatus'])->group(function () {
    Route::get('/trades', [TradeController::class, 'index'])->name('trade.index');
    Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
    Route::get('/market', [MarketController::class, 'index'])->name('market.index');
    Route::get('/crypto-market', [MarketController::class, 'cryptoData'])->name('crypto-market');
    Route::get('/transactions', [WalletController::class, 'transaction'])->name('transaction.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/share', [UserController::class, 'shareIndex'])->name('share.index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    Route::get('/address', [UserController::class, 'address'])->name('address.index');

    Route::post('/deposit/ipn', [DepositController::class, 'ipn'])->name('deposits.ipn');
    Route::post('/deposit/store', [DepositController::class, 'store'])->name('deposits.store');
    Route::get('/deposit/{deposit}', [DepositController::class, 'show'])->name('deposits.show');
    Route::get('/identity-verification', [KycController::class, 'index'])->name('kyc.index');
    Route::post('/kyc-store', [KycController::class, 'store'])->name('kyc.store');
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('notification.delete');

});

Route::get('/help', [HelpController::class, 'index'])->name('help.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
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

// dashboard route start here
Route::middleware(['isAdmin', 'auth', 'checkUserStatus'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users_overview', [UserController::class, 'index'])->name('admin.user');
    Route::prefix('admin')->group(function () {
        Route::resource('signals', SignalController::class)->names('admin.signals');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/trades/pending', [TradeApprovalController::class, 'pendingTrades'])->name('admin.trades.pending');
        Route::get('/trades/{id}/details', [TradeApprovalController::class, 'getTradeDetails']);
        Route::post('/trades/approve', [TradeApprovalController::class, 'approveTrade'])->name('admin.trades.approve');
        Route::delete('/trades/{id}/reject', [TradeApprovalController::class, 'rejectTrade'])->name('admin.trades.reject');
    });
    Route::get('deposit', [DepositController::class, 'index'])->name('deposits.index');
    Route::get('withdraw', [WithdrawController::class, 'index'])->name('withdraws.index');
    Route::post('withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');
    Route::get('transfer', [TransferController::class, 'index'])->name('transfers.index');
    Route::post('/deposits/{deposit}/update-status', [DepositController::class, 'updateStatus'])->name('deposits.updateStatus');
    Route::get('trades_overview', [TradeController::class, 'history'])->name('trade.dashboard');
    Route::put('/admin/users/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/admin/users/update-kyc', [UserController::class, 'updateKyc'])->name('admin.users.update-kyc');
    Route::delete('/users/del/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('wallet', [WalletController::class, 'history'])->name('wallet.dashboard');
    Route::prefix('wallet/transaction')->group(function () {
        Route::get('/', [WalletController::class, 'wallet_history'])->name('wallet.transaction.index');
        Route::put('/update/{id}', [WalletController::class, 'update'])->name('wallet.transaction.update');
        Route::get('/delete/{id}', [WalletController::class, 'destroy'])->name('wallet.transaction.delete');
    });
    Route::get('/logout', function () {
        Auth::logout();
        session()->flush();

        return redirect('/login');
    });

    Route::post('/withdraws/{withdraw}/update-status', [WithdrawController::class, 'updateStatus'])->name('withdraws.updateStatus');
});

Route::get('/crypto', [CryptoController::class, 'index'])->name('crypto.index');
Route::post('/execute-trade', [TradeController::class, 'executeTrade'])->name('execute.trade');
Route::get('/crypto-data', [CryptoController::class, 'fetchData'])->name('crypto.data');
Route::post('/wallet/address/store', [WalletController::class, 'store'])->name('wallet.address.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/notifications/latest', [NotificationController::class, 'getLatestNotifications']);
    Route::get('/user/notifications/count', [NotificationController::class, 'getUnreadCount']);
});

// Route::get('/lang/{lang}', function ($lang) {
//     session(['locale' => $lang]);
//     return back();
// })->name('change.lang');
// web.php
Route::post('/transfer/process', [TransferController::class, 'processTransfer'])->name('transfers.process');
Route::get('/user/wallet-data', [UserController::class, 'getWalletData'])->name('user.wallet.data');

Route::get('/lang/{lang}', function ($lang) {
    $allowed = ['en', 'ur', 'fr', 'es', 'ar'];

    if (! in_array($lang, $allowed)) {
        $lang = 'en';
    }

    session(['locale' => $lang]);

    return back();
})->name('change.lang');

// Route::post('/set-language', function () {
//     session(['app_locale' => request('lang')]);
//     return response()->json(['success' => true]);
// });

// Route::get('/invite', [UserController::class, 'index'])->middleware('auth');
