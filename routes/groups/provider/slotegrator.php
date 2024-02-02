<?php

use App\Http\Controllers\Provider\SlotegratorController;
use Illuminate\Support\Facades\Route;

Route::get('selfvalidation', [SlotegratorController::class, 'selfValidationMethod']);
Route::get('limit', [SlotegratorController::class, 'limitMethod']);
Route::any('slotegrator/webhooks', [SlotegratorController::class, 'webhookMethod']);
