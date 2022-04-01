<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\BetslipController;
use App\Http\Controllers\GameController;
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
Route::post('v1/balances/{user:id}/balance', [BalanceController::class, 'store']);
Route::get('v1/balances/{user:id}/balance', [BalanceController::class, 'index']);

//Post Games from API TO DB
Route::post('v1/games', [GameController::class, 'store']); 
Route::get('v1/games', [GameController::class, 'index']);

// Add Betslip Cart
Route::post('v1/betslips', [BetslipController::class, 'store']);

// Get all bets in current browser session
Route::get('v1/betslips/sessions/{betslip:session_id}/session', [BetslipController::class, 'session_show']);

// Get Betslip Cart odds total
Route::get('v1/betslips/sessions/{betslip:session_id}/session/odds-total', [BetslipController::class, 'odds_total']);

// Calculate Cart Payout
Route::post('v1/betslips/sessions/{betslip:session_id}/session/payout', [BetslipController::class, 'payout']);
Route::get('v1/betslips/sessions/{betslip:session_id}/session/payout', [BetslipController::class, 'payout_index']);

// Post Final Cart
Route::post('v1/betslips/sessions/{betslip:session_id}/session/users/{user:id}/user/payout', [BetslipController::class, 'cart']);

// Get all placed bets
Route::get('v1/betslips/sessions/{betslip:session_id}/session/users/{user:id}/user/cart', [BetslipController::class, 'cart_index']);

// Betslip Checkout
Route::post('v1/betslips/sessions/{betslip:session_id}/session/users/{user:id}/user/checkout', [BetslipController::class, 'checkout']);

// Get all betslips that have been placed
Route::get('v1/betslips/{user:id}/betslip', [BetslipController::class, 'betslip_show']);

// Remove single game from bet cart
Route::delete('v1/betslips/sessions/{session_id}/session/games/{game_id}/game', [BetslipController::class, 'game_destroy']);

// Remove all games in current session
Route::delete('v1/betslips/sessions/{betslip:session_id}/session', [BetslipController::class, 'betslip_destroy']);


require __DIR__.'/auth.php';