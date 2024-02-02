<?php
use App\Http\Controllers\Provider\VibraController;
use Illuminate\Support\Facades\Route;

Route::get('vibra/', [VibraController::class, 'index']);
Route::get('vibra/webhooks/{parameters?}', [VibraController::class, 'webhookMethod']);
