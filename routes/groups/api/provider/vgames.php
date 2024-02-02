<?php

use App\Http\Controllers\Api\Providers\VGamesController;
use Illuminate\Support\Facades\Route;

Route::prefix('vgames')
    ->group(function ()
    {
        Route::any('/{token}/{action}', [VGamesController::class, 'vgameProvider']);
    });
