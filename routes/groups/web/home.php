<?php

use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/como-funciona', [HomeController::class, 'howWorks']);
Route::get('/suporte', [HomeController::class, 'suporte']);
Route::get('/sobre-nos', [HomeController::class, 'aboutUs']);
Route::get('/banned', [HomeController::class, 'banned']);
