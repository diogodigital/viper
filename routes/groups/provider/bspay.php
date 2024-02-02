<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gateway\BsPayController;


Route::post('bspay/qrcode-pix', [BsPayController::class, 'getQRCodePix']);
Route::any('bspay/callback', [BsPayController::class, 'callbackMethod']);
Route::post('bspay/consult-status-transaction', [BsPayController::class, 'consultStatusTransactionPix']);

Route::get('bspay/withdrawal/{id}', [BsPayController::class, 'withdrawalFromModal'])->name('bspay.withdrawal');
Route::get('bspay/cancelwithdrawal/{id}', [BsPayController::class, 'cancelWithdrawalFromModal'])->name('bspay.cancelwithdrawal');
