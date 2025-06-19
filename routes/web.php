<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SipCalculatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Main dashboard (accessible to all)
Route::get('/', [SipCalculatorController::class, 'index'])->name('dashboard');

// Authentication routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// SIP Calculator Routes
Route::post('/sip-calculator/calculate', [SipCalculatorController::class, 'calculate'])->name('sip.calculate');
Route::get('/sip-calculator/history', [SipCalculatorController::class, 'history'])->middleware('auth')->name('sip.history');

// Google Login Routes
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
