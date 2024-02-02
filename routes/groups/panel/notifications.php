<?php

use App\Http\Controllers\Panel\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('notifications')
    ->as('notifications.')
    ->group(function ()
    {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
    });
