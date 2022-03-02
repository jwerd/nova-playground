<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServerHeartbeat extends Model
{
    use HasFactory;
    
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
