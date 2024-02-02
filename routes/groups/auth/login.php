<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function() {
    return redirect()->to('/admin/login');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/forgot-password',  [ResetPasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/send-reset-link', [ResetPasswordController::class, 'sendResetLink']);
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm']);
Route::post('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword']);
