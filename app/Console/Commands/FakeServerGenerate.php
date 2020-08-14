<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Server;
use App\Models\ServerHeartbeat;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class FakeServerGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $faker;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //dd($this->generateAttributes(1));

        $games = Game::all();

        $servers = $this->generateServers($games, rand(10,100));

        $heartbeats = $this->generateHeatbeats($servers, 86400);
    }

    protected function generateServers($games, $num = 1)
    {
        $servers = [];
        foreach($games as $game) {
            // Generate servers
            for($i = 0; $i <= $num; $i++) {
                $current = rand(0,30);
                $max     = $current+rand(0,20);
                $created = now()->subMinutes(rand(5,100000));
                $servers[] = Server::create([
                    'game_id' => $game->id,
                    'title' => $this->faker->word." ".$i,
                    'address' => $this->faker->ipv4,
                    'port'    => rand(1000,9999),
                    'query_port' => rand(1000,9999),
                    'current_player_count' => $current,
                    'max_player_count'     => $max,
                    'last_queried' => now(),
                    'created_at' => $created,
                    'updated_at' => $created,
                ]);
            }
        }

        return $servers;
    }

    protected function generateHeatbeats($servers, $num = 1)
    {
        $heartbeats = [];
        foreach($servers as $server) {
            $start = 0;
            while($start < $num) {
                $start += 300;
                ServerHeartbeat::create([
                    'server_id' => $server->id,
                    'current_player_count' => rand(0,30),
                    'created_at' => now()->subSeconds($start),
                    'updated_at' => now()->subSeconds($start)
                ]);
            }
        }

        return $heartbeats;
    }
    
    protected function generateAttributes($server_id)
    {
        $attributes = [
            'version'     => rand(1000,2999),
            'server_type' => ['pvp', 'pve'],
            'location'    => ['US', 'CA', 'EU'],
            'platform'    => ['Windows', 'Linux', 'Mac'],
            'map'         => 'random_generated_map_hash_'.rand(0,10000),
            'last_wipe'   => now()->subDays(rand(0,30)),
        ];

        $selectedAttributes = Arr::random($attributes, rand(0, count($attributes)));

        dd($selectedAttributes);

    }
}
