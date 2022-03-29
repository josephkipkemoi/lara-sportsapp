<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('v1/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('v1/register', [RegisteredUserController::class, 'store']);

    Route::get('v1/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('v1/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('v1/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('v1/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('v1/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('v1/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('v1/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('v1/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('v1/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('v1/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('v1/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('v1/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
