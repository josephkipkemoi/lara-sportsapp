<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'game_id' => $this->faker->numberBetween(0,10),
            'game_category' => $this->faker->word(),
            'kick_off_time' => $this->faker->time(),
            'home_team' => $this->faker->word(),
            'away_team' => $this->faker->word(),
            'odds_home' => $this->faker->numberBetween(1,3),
            'odds_away' => $this->faker->numberBetween(2,5)
        ];
    }
}
