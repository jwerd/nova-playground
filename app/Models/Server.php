<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use \Spatie\Tags\HasTags;

    protected $fillable = [
        'title',
        'game_id',
        'address',
        'current_player_count',
        'max_player_count',
        'port',
        'query_port',
        'last_queried',
    ];

    public $casts = ['last_queried' => 'datetime'];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function heartbeat() {
        return $this->hasMany(ServerHeartbeat::class);
    }
}
