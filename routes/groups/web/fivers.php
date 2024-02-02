<?php

use App\Http\Controllers\Provider\FiversController;
use Illuminate\Support\Facades\Route;

Route::get('/fivers/{code}', [FiversController::class, 'show'])->name('fivers.show');
Route::get('/fivers', [FiversController::class, 'getListGame'])->name('fivers.list');
