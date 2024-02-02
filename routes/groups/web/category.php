<?php

use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/categoria/{slug}', [HomeController::class, 'showGameByCategory'])->name('category.index');
