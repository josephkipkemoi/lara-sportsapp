<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\BetslipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Balance
Route::post('/balances/{user}/balance', [BalanceController::class, 'store'])->name('balance.store');
Route::get('/balances/{user}/balance', [BalanceController::class, 'index'])->name('balance.index');

// Add Cart
Route::post('/betslip', [BetslipController::class, 'store'])->name('betslip.store');
