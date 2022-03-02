<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Game;

class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $current = rand(0,30);
        $max     = $current+rand(0,20);
        return [
            'title' => $this->faker->name,
            'game_id' => Game::factory()->create(),
            'address' => $this->faker->ipv4,
            'port'    => rand(1000,9999),
            'query_port' => rand(1000,9999),
            'current_player_count' => $current,
            'max_player_count'     => $max,
            'last_queried'         => now(),
        ];
    }
}
