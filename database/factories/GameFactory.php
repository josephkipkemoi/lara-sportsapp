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
            'betslip_team_names' => $this->faker->name(),
            'betslip_market' => $this->faker->name(),
            'betslip_market_odds' => $this->faker->numberBetween(2,5)
        ];
    }
}
