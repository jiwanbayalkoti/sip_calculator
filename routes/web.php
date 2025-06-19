<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MutualFundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SipCalculatorController;
use App\Http\Controllers\LumpsumCalculatorController;
use App\Http\Controllers\GoalBasedCalculatorController;
use App\Http\Controllers\StepUpCalculatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// SIP Calculator Routes
Route::get('/sip-calculator', [SipCalculatorController::class, 'index'])->name('sip-calculator');
Route::post('/sip-calculator/calculate', [SipCalculatorController::class, 'calculate'])->name('sip-calculator.calculate');
Route::get('/sip-calculator/history', [SipCalculatorController::class, 'history'])->name('sip-calculator.history');

// Lumpsum Calculator Routes
Route::get('/lumpsum-calculator', [LumpsumCalculatorController::class, 'index'])->name('lumpsum-calculator');
Route::post('/lumpsum-calculator/calculate', [LumpsumCalculatorController::class, 'calculate'])->name('lumpsum-calculator.calculate');
Route::get('/lumpsum-calculator/history', [LumpsumCalculatorController::class, 'history'])->name('lumpsum-calculator.history');

// Goal-Based Calculator Routes
Route::get('/goal-based-calculator', [GoalBasedCalculatorController::class, 'index'])->name('goal-based-calculator');
Route::post('/goal-based-calculator/calculate', [GoalBasedCalculatorController::class, 'calculate'])->name('goal-based-calculator.calculate');
Route::get('/goal-based-calculator/history', [GoalBasedCalculatorController::class, 'history'])->name('goal-based-calculator.history');

// Step-Up Calculator Routes
Route::get('/step-up-calculator', [StepUpCalculatorController::class, 'index'])->name('step-up-calculator');
Route::post('/step-up-calculator/calculate', [StepUpCalculatorController::class, 'calculate'])->name('step-up-calculator.calculate');
Route::get('/step-up-calculator/history', [StepUpCalculatorController::class, 'history'])->name('step-up-calculator.history');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');

// Mutual Fund Routes
Route::get('/mutual-funds', [MutualFundController::class, 'index'])->name('mutual-funds.index');
Route::get('/mutual-funds/compare', [MutualFundController::class, 'compare'])->name('mutual-funds.compare');
Route::get('/mutual-funds/{fund}', [MutualFundController::class, 'show'])->name('mutual-funds.show');
Route::get('/mutual-funds/ranking', [MutualFundController::class, 'ranking'])->name('mutual-funds.ranking');
Route::get('/mutual-funds/search', [MutualFundController::class, 'search'])->name('mutual-funds.search');

// Static Pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('pages.terms-of-service');
})->name('terms-of-service');

Route::get('/glossary', function () {
    return view('pages.glossary');
})->name('glossary');

Route::get('/investment-quiz', function () {
    return view('pages.investment-quiz');
})->name('investment-quiz');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
