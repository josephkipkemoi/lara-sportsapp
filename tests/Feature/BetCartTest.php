<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BetCartTest extends TestCase
{
    use WithFaker;
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_add_game_to_cart()
    {
        $user = User::factory()->create();
        // $game1 = Game::factory()->create();
        // $game2 = Game::factory()->create();
        // $game3 = Game::factory()->create();

        $response = $this->post('api/betslip',[
            'user_id' => $user->id,
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 1,
        ]);

        // $this->post('api/betslip',[
        //     'game_id' => $game1->id,
        //     'betslip_team_names' => $game1->betslip_team_names,
        //     'betslip_market' => $game1->betslip_market,
        //     'betslip_market_odds' =>$game1->betslip_market_odds,
        // ]);

        // $this->post('api/betslip',[
        //     'game_id' => $game2->id,
        //     'betslip_team_names' => $game2->betslip_team_names,
        //     'betslip_market' => $game2->betslip_market,
        //     'betslip_market_odds' =>$game2->betslip_market_odds,
        // ]);

        // $this->post('api/betslip',[
        //     'game_id' => $game2->id,
        //     'betslip_team_names' => $game2->betslip_team_names,
        //     'betslip_market' => $game2->betslip_market,
        //     'betslip_market_odds' =>$game2->betslip_market_odds,
        // ]);

        // $this->post('api/betslip',[
        //     'game_id' => $game3->id,
        //     'betslip_team_names' => $game3->betslip_team_names,
        //     'betslip_market' => $game3->betslip_market,
        //     'betslip_market_odds' =>$game3->betslip_market_odds,
        // ]);

        $response->assertCreated();

    }
}
