<?php

use App\Http\Controllers\Provider\FiversController;
use Illuminate\Support\Facades\Route;

Route::post('gold_api', [FiversController::class, 'webhookMethod']);
