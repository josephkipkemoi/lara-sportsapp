<?php

namespace Tests\Feature;

use App\Models\Betslip;
use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BetCartTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthenticated_user_can_add_game_to_cart()
    {
        $response = $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 1,
        ]);

        $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 2,
            'betslip_team_names' => 'aa',
            'betslip_market' => 'mm',
            'betslip_market_odds' => 2,
        ]);

        $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 1,
            'betslip_team_names' => 'Man',
            'betslip_market' => '3 way',
            'betslip_market_odds' => 3,
        ]);

        $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 3,
            'betslip_team_names' => 'f',
            'betslip_market' => 'game2->betslip_market',
            'betslip_market_odds' => 2,
        ]);

        $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 2,
            'betslip_team_names' => '$game3->betslip_team_names',
            'betslip_market' => '$game3->betslip_market',
            'betslip_market_odds' => 88,
        ]);

        $response->assertOk();

    }

    public function test_can_add_betslip_odds()
    {
        $slip1 = $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4,
        ]);

        $slip2 = $this->post('api/betslip',[
            'session_id' => session()->getId(),
            'game_id' => 2,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $response = $this->get('api/betslip/odds-total');

        $odds_total = $slip1->getData()->betslip_market_odds * $slip2->getData()->betslip_market_odds;

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     "odds_total" => $odds_total
                 ]);
    }
}
