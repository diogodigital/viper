<?php

use App\Http\Controllers\Panel\WalletController;
use Illuminate\Support\Facades\Route;

Route::prefix('wallet')
    ->as('wallet.')
    ->group(function ()
    {
        Route::get('/', [WalletController::class, 'index'])->name('index');
        Route::get('/withdrawals', [WalletController::class, 'viewWithdrawals'])->name('withdrawals');
        Route::get('/deposits', [WalletController::class, 'viewDeposits'])->name('deposits');
        Route::get('/hide-balance', [WalletController::class, 'hideBalance'])->name('hidebalance');


        Route::post('/deposit', [WalletController::class, 'generateDeposit'])->name('deposit');
        Route::post('/withdrawal', [WalletController::class, 'requestWithdrawal'])->name('withdrawal');
    });
