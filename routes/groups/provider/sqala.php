<?php

use App\Http\Controllers\Gateway\SqalaController;
use Illuminate\Support\Facades\Route;


Route::post('sqala/qrcode-pix', [SqalaController::class, 'getQRCodePix']);
Route::any('sqala/callback', [SqalaController::class, 'callbackMethod']);
Route::post('sqala/consult-status-transaction', [SqalaController::class, 'consultStatusTransactionPix']);
Route::get('sqala/withdrawal/{id}', [SqalaController::class, 'withdrawalFromModal'])->name('sqala.withdrawal');
Route::get('sqala/cancelwithdrawal/{id}', [SqalaController::class, 'cancelWithdrawalFromModal'])->name('sqala.cancelwithdrawal');
