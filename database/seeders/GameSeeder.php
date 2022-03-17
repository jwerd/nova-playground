<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            ['name' => 'Rust', 'active' => true],
            ['name' => 'DayZ', 'active' => true],
            ['name' => 'Minecraft', 'active' => true]
        ];
        Game::factory()->createMany($games);
    }
}
