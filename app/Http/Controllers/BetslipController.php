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
        // Check if game id is available on the Betslip resource
        // If it its found update the values otherwise create a new resource 
       $slip = Betslip::where('game_id', $request->validated()['game_id'])->first();
       
       if($slip !== null) {
           $slip->update([
                'betslip_team_names' => $request->validated()['betslip_team_names'],
                'betslip_market' => $request->validated()['betslip_market'],
                'betslip_market_odds' =>  $request->validated()['betslip_market_odds'],
           ]);
       } else {
           $slip = Betslip::create([
            'game_id' => $request->validated()['game_id'],
            'betslip_team_names' => $request->validated()['betslip_team_names'],
            'betslip_market' => $request->validated()['betslip_market'],
            'betslip_market_odds' =>  $request->validated()['betslip_market_odds'],
           ]);
       }

        return $slip;
    }
}
