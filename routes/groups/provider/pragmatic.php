<?php

use App\Http\Controllers\Provider\PragmaticController;
use Illuminate\Support\Facades\Route;

Route::prefix('pragmatic')
    ->as('pragmatic.')
    ->middleware(['auth'])
    ->group(function ()
    {

    });
