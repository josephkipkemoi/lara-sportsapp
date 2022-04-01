<?php

namespace Tests\Feature;

use App\Models\Betslip;
use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

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
        $response = $this->post('api/v1/betslips',[
            'session_id' => 1,
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 1,
        ]);

        $this->post('api/v1/betslips',[
            'session_id' => 1,
            'game_id' => 2,
            'betslip_team_names' => 'aa',
            'betslip_market' => 'mm',
            'betslip_market_odds' => 2,
        ]);

        $this->post('api/v1/betslip',[
            'session_id' => 1,
            'game_id' => 1,
            'betslip_team_names' => 'Man',
            'betslip_market' => '3 way',
            'betslip_market_odds' => 3,
        ]);

        $this->post('api/v1/betslips',[
            'session_id' => 2,
            'game_id' => 3,
            'betslip_team_names' => 'f',
            'betslip_market' => 'game2->betslip_market',
            'betslip_market_odds' => 2,
        ]);

        $this->post('api/v1/betslips',[
            'session_id' => 2,
            'game_id' => 2,
            'betslip_team_names' => '$game3->betslip_team_names',
            'betslip_market' => '$game3->betslip_market',
            'betslip_market_odds' => 88,
        ]);

        $response->assertOk();

    }

    public function test_can_calculate_total_betslip_odds()
    {
        $session_id = 1;

        $slip1 = $this->post('api/v1/betslips',[
            'session_id' => $session_id,
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4,
        ]);

        $slip2 = $this->post('api/v1/betslips',[
            'session_id' => $session_id,
            'game_id' => 2,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $response = $this->get("api/v1/betslips/sessions/{$session_id}/session/odds-total");

        $odds_total = $slip1->getData()->betslip_market_odds * $slip2->getData()->betslip_market_odds;
 
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     "odds_total" => $odds_total
                 ]);
    }

    public function test_can_get_all_games_in_current_session()
    {
        $betslip = Betslip::create([
            'session_id' => session()->getId(),
            'game_id' => 2,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $response = $this->get("api/v1/betslips/sessions/{$betslip->session_id}/session");

        $response->assertOk()
                 ->assertJsonFragment([
                     'count' => $betslip->count()
                 ]);
    }

    public function test_can_delete_single_game_in_betslip_cart()
    {
        $betslip = Betslip::create([
            'session_id' => 1,
            'game_id' => 2,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $response = $this->delete("api/v1/betslips/sessions/{$betslip->session_id}/session/games/{$betslip->game_id}/game");

        $response->assertOk();
 
    }

    public function test_can_delete_betslip_cart()
    {
        $betslip = Betslip::create([
            'session_id' => session()->getId(),
            'game_id' => 2,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $response = $this->delete("api/v1/betslips/sessions/{$betslip->session_id}/session");

        $betslips = $this->get("api/v1/betslips/sessions/{$betslip->session_id}/session");

        $response->assertOk();

        $betslips->assertJsonFragment([
            'count' => 0
        ]);

    }

    public function test_can_post_final_betslip_cart()
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user->balance()->create([
            'amount' => 100
        ]);


        $betslip = Betslip::create([
            'session_id' => 1,
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        Betslip::create([
            'session_id' => 1,
            'game_id' => 1,
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4.3,
        ]);

        $total_odds = $this->get("api/v1/betslips/sessions/{$betslip->session_id}/session/odds-total")->getData()->odds_total;

        $final_payout = $total_odds * 100;
        
        $stake_amount = 100;

        $response = $this->post("api/v1/betslips/sessions/{$betslip->session_id}/session/users/{$user->id}/user/checkout", [
            'bet_id' => Str::random(6),            
            'stake_amount' => $stake_amount,
            'final_payout' => $final_payout,
            'total_odds' => $total_odds
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'message',
        ]);    

    }

    public function test_user_can_get_all_placed_bets()
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user->balance()->create([
            'amount' => 1000
        ]);

        $betslip = Betslip::create([
            'session_id' => 1,
            'game_id' => 2,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $total_odds = $this->get("api/v1/betslips/sessions/{$betslip->session_id}/session/odds-total")->getData()->odds_total;

        $final_payout = $total_odds * 100;

        $this->post("api/v1/betslips/sessions/{$betslip->session_id}/session/users/{$user->id}/user/checkout", [
            'bet_id' => Str::random(6),            
            'stake_amount' => 100,
            'final_payout' => $final_payout,
            'total_odds' => $total_odds
        ]);

        $response = $this->get("api/v1/betslips/{$user->id}/betslip");

        $response->assertOk()
                 ->assertJsonFragment([
                     'count' => 1
                 ]);
    }

    public function test_can_calculate_possible_payout()
    {
        $session_id = 1;

        $this->post('api/v1/betslips',[
            'session_id' => $session_id,
            'game_id' => 1,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4,
        ]);

        $this->post('api/v1/betslips',[
            'session_id' => $session_id,
            'game_id' => 2,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $total_odds = $this->get("api/v1/betslips/sessions/{$session_id}/session/odds-total")->getData()->odds_total;

        $stake_amount = 100;

        $payout = $total_odds * $stake_amount;

        $response = $this->post("api/v1/betslips/sessions/{$session_id}/session/payout", [
            'session_id' => $session_id,
            'stake_amount' => $stake_amount,
            'payout' => $payout
        ]);

        $response->assertOk()
                  ->assertJsonFragment([
                      'payout' => $payout
                  ]);
    }

    public function test_can_get_calculated_possible_payout()
    {
        $session_id = 1;

        $this->post('api/v1/betslips',[
            'session_id' => $session_id,
            'game_id' => 1,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4,
        ]);

        $this->post('api/v1/betslips',[
            'session_id' => $session_id,
            'game_id' => 2,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 3,
        ]);

        $total_odds = $this->get("api/v1/betslips/sessions/{$session_id}/session/odds-total")->getData()->odds_total;

        $stake_amount = 100;

        $payout = $total_odds * $stake_amount;

        $this->post("api/v1/betslips/sessions/{$session_id}/session/payout", [
            'session_id' => $session_id,
            'stake_amount' => $stake_amount,
            'payout' => $payout
        ]);

        $response = $this->get("api/v1/betslips/sessions/{$session_id}/session/payout");

        $response->assertOk()
                 ->assertJsonFragment([
                    'payout' => $payout
                 ]);
    }

    public function test_authenticated_user_can_post_checkout_cart()
    {
        $user = User::factory()->create();

        $session_id = $this->post('api/v1/betslips',[
            'session_id' => 1,
            'game_id' => 1,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4,
        ])->getData()->session_id;

        $total_odds = $this->get("api/v1/betslips/sessions/{$session_id}/session/odds-total")->getData()->odds_total;

        $stake_amount = 100;

        $final_payout = $this->post("api/v1/betslips/sessions/{$session_id}/session/payout", [
            'session_id' => $session_id,
            'stake_amount' => $stake_amount,
        ])->getData()->payout;

        $response = $this->post("api/v1/betslips/sessions/{$session_id}/session/users/{$user->id}/user/payout", [
            'session_id' => $session_id,
            'user_id' => $user->id,
            'bet_id' => Str::random(6),
            'stake_amount' => $stake_amount,
            'total_odds' => $total_odds,
            'final_payout' => $final_payout 
        ]);

        $response->assertOk()
                 ->assertJsonFragment([
                     'message' => 'Bet placed successfully',
                 ]);    
    }

    public function test_authenticated_user_can_get_all_placed_bets()
    {
        $user = User::factory()->create();

        $session_id = $this->post('api/v1/betslips',[
            'session_id' => 1,
            'game_id' => 1,
            'bet_id' => Str::random(6),
            'betslip_team_names' => '$game1->betslip_team_names',
            'betslip_market' => '$game1->betslip_market',
            'betslip_market_odds' => 4,
        ])->getData()->session_id;

        $total_odds = $this->get("api/v1/betslips/sessions/{$session_id}/session/odds-total")->getData()->odds_total;

        $stake_amount = 100;

        $final_payout = $this->post("api/v1/betslips/sessions/{$session_id}/session/payout", [
            'session_id' => $session_id,
            'stake_amount' => $stake_amount,
        ])->getData()->payout;

        $this->post("api/v1/betslips/sessions/{$session_id}/session/users/{$user->id}/user/payout", [
            'session_id' => $session_id,
            'user_id' => $user->id,
            'bet_id' => Str::random(6),
            'stake_amount' => $stake_amount,
            'total_odds' => $total_odds,
            'final_payout' => $final_payout 
        ]);

        $response = $this->get("api/v1/betslips/sessions/{$session_id}/session/users/{$user->id}/user/cart");

        $response->assertOk()
                 ->assertJsonFragment([
                     'count' => 1
                 ])
                 ->assertJsonStructure([
                     'count',
                     'data'
                 ]);
    }
}
