<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_post_game_from_api()
    {
        $response = $this->post('api/v1/games', [
            'game_id' => 1,
            'game_category' => 'Baseball',
            'kick_off_time' => 10000,
            'home_team' => 'Team A',
            'away_team' => 'Team B',
            'odds_home' => 1.3,
            'odds_away' => 1.4
        ]);

        $response->assertStatus(200);
    }

    public function test_can_get_games_from_database()
    {
        $game = Game::factory()->create();

        $response = $this->get('api/v1/games');

        $response->assertOk()
                 ->assertJsonStructure([
                     'data'
                ]);
    }
}