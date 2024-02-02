<?php


use App\Http\Controllers\Provider\VibraController;
use Illuminate\Support\Facades\Route;

Route::get('vibragames/{id}', [VibraController::class, 'show'])->name('vibragames.show');
