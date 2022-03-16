<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BalanceTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_post_balance()
    {
        $user = User::factory()->create();

        $response = $this->post("api/balances/{$user->id}/balance", [
            'amount' => $this->faker()->numberBetween(100,1000)
        ]);

        $response->assertOk();
    }

    public function test_user_can_get_balance()
    {
        $user = User::factory()->create();

        $user->balance()->create([
            'amount' => $this->faker()->numberBetween(50, 1000)
        ]);

        $response = $this->get("api/balances/{$user->id}/balance");

        $response->assertOk();
    }
}
