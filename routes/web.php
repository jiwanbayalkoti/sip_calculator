<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SipCalculatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// SIP Calculator Routes
Route::get('/sip-calculator', [SipCalculatorController::class, 'index'])->name('sip.calculator');
Route::post('/sip-calculator/calculate', [SipCalculatorController::class, 'calculate'])->name('sip.calculate');
Route::get('/sip-calculator/history', [SipCalculatorController::class, 'history'])->middleware('auth')->name('sip.history');

require __DIR__.'/auth.php';
