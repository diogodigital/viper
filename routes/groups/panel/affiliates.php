<?php

use App\Http\Controllers\Panel\AffiliateController;
use Illuminate\Support\Facades\Route;

Route::prefix('affiliates')
    ->as('affiliates.')
    ->group(function () {
        Route::get('/', [AffiliateController::class, 'index'])->name('index');
        Route::post('/withdrawal', [AffiliateController::class, 'getWithdrawal'])->name('withdrawal');
    });
