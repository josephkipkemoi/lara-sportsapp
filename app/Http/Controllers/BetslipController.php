<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBetslipRequest;
use App\Models\Balance;
use App\Models\Betslip;
use App\Models\CheckoutBetCart;
use App\Models\Game;
use App\Models\Payout;
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
            'session_id' => $request->validated()['session_id'],
            'game_id' => $request->validated()['game_id'],
            'betslip_team_names' => $request->validated()['betslip_team_names'],
            'betslip_market' => $request->validated()['betslip_market'],
            'betslip_market_odds' =>  $request->validated()['betslip_market_odds'],
           ]);
       }

       return response()
                    ->json([
                        'session_id' => $slip->session_id,
                        'game_id' => $slip->game_id,
                        'betslip_team_names' => $slip->betslip_team_names,
                        'betslip_market' => $slip->betslip_market,
                        'betslip_market_odds' =>  $slip->betslip_market_odds,
                    ]);
    }

    public function odds_total($id)
    {
        $betslips = Betslip::where('session_id', $id)->get();

        $odds_total = 1;

        foreach($betslips as $betslip)
        {
            $odds_total *= $betslip->betslip_market_odds;
        }

        return response()
                    ->json([
                        'odds_total' => $odds_total
                    ]);
    }

    public function game_destroy($session_id, $game_id)
    {
        Betslip::where(['session_id' => $session_id,'game_id' => $game_id])->delete();

        return response()
                    ->json([
                        'message' => 'Game deleted succefully'
                    ]);
    }

    public function session_show($id)
    {
        $betslips = Betslip::where('session_id', $id)->get();

        $betslips_count = Betslip::where('session_id', $id)->count();

        return response()
                    ->json([
                        'data' => $betslips,
                        'count' => $betslips_count
                    ]);
    }

    public function betslip_destroy($id)
    {
        Betslip::where('session_id', $id)->delete();

        return response()
                    ->json([
                        'message' => 'Betslip removed successfully'
                    ]);
    }

    public function checkout($session_id, $user_id)
    {
        $data = request()->validate([
            'stake_amount' => ['required', 'numeric'],
            'final_payout' => ['required', 'numeric'],
            'total_odds' => ['required', 'numeric']
        ]);

        $user_balance = Balance::where('user_id', $user_id)->first()->amount;

        $stake_amount = $data['stake_amount'];

        $total_odds = $data['total_odds'];

        $final_payout = $stake_amount * $total_odds;

        if($user_balance < $stake_amount)
        {
            return response()
                        ->json([
                            'message' => 'Add more stake to place bet'
                        ]);
        }
        else 
        {
            CheckoutBetCart::create([
                'user_id' => $user_id,
                'session_id' => $session_id,
                'stake_amount' => $stake_amount,
                'total_odds' => $total_odds,
                'final_payout' => $final_payout
            ]);

            // Subtract balance from stake
            Balance::where('user_id', $user_id)->decrement('amount', $stake_amount);

            return response()
            ->json([
                'message' => 'Congratulations! Bet placed successfully'
            ]);
        }
     
      

    }

    public function betslip_show($user_id)
    {
        $betslips = CheckoutBetCart::where('user_id', $user_id)->get();

        $betslip_count = $betslips->count();

        return response()
                    ->json([
                        'count' => $betslip_count,
                        'data' => $betslips 
                    ]);
    }

    public function payout($session_id)
    {
        $data = request()->validate([
            'stake_amount' => ['required', 'numeric']
        ]);

        $betslip_odds = $this->odds_total($session_id)->getData()->odds_total;

        $payout = $data['stake_amount'] * $betslip_odds;

        $checkout_cart = Payout::create([
            'session_id' => $session_id,
            'payout' =>  $payout
        ]);

        return response()
                    ->json([
                        'payout' => $checkout_cart->payout
                    ]);
    }

    public function cart()
    {
        $data = request()->validate([
            'user_id' => ['required', 'numeric'],
            'session_id' => ['required', 'numeric'],
            'stake_amount' => ['required', 'numeric'],
            'total_odds' => ['required', 'numeric'],
            'final_payout' => ['required', 'numeric']
        ]);

        CheckoutBetCart::create([
            'user_id' => $data['user_id'],
            'session_id' => $data['session_id'],
            'stake_amount' => $data['stake_amount'],
            'total_odds' => $data['total_odds'],
            'final_payout' => $data['final_payout']
        ]);

        return response()
                    ->json([
                        'message' => 'Bet placed successfully'
                    ]);
    }
}
