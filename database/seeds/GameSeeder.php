<?php

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Game::class)->create([
            'name' => 'Rust',
            'active' => true,
        ]);
    }
}
