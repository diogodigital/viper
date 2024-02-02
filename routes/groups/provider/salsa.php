<?php

use App\Http\Controllers\Provider\SalsaController;
use Illuminate\Support\Facades\Route;

Route::post('salsa/webhooks', [SalsaController::class, 'webhookMethod']);
