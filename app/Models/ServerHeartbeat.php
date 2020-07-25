<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerHeartbeat extends Model
{
    protected $fillable = [
        'server_id',
        'current_player_count',
        'created_at',
        'updated_at'
    ];

    public function server() {
        return $this->belongsTo(Server::class);
    }

}
