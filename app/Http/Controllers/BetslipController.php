<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBetslipRequest;
use App\Models\Betslip;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class BetslipController extends Controller
{
    //
    public function store(User $user,StoreBetslipRequest $request)
    {

        $betslip = Betslip::create([
            'user_id' => $request->validated()['user_id'],
            'game_id' => $request->validated()['game_id'],
            'betslip_team_names' => $request->validated()['betslip_team_names'],
            'betslip_market' => $request->validated()['betslip_market'],
            'betslip_market_odds' =>  $request->validated()['betslip_market_odds'],
        ]);

        dd($betslip->user_id);
    }
}
