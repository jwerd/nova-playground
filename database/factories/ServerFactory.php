<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Server;
use Faker\Generator as Faker;

$factory->define(Server::class, function (Faker $faker) {
    $current = rand(0,30);
    $max     = $current+rand(0,20);
    return [
        'title' => $faker->name,
        'game_id' => factory(App\Models\Game::class),
        'address' => $faker->ipv4,
        'port'    => rand(1000,9999),
        'query_port' => rand(1000,9999),
        'current_player_count' => $current,
        'max_player_count'     => $max,
        'last_queried'         => now(),
    ];
});
