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
        'created_at',
        'updated_at',
    ];

    public $casts = ['last_queried' => 'datetime'];

    protected static function booted()
    {
        static::created(function ($model) {
            $attributes = [];
            foreach(config('attributes') as $property => $val) {
                $attributes = [
                    'property'       => $property,
                    'property_value' => '',
                ];
                $model->attributes()->create($attributes);
            }
        });
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function heartbeat() {
        return $this->hasMany(ServerHeartbeat::class);
    }
    
    /**
     * Get all of the games's attributes.
     */
    public function attributes()
    {
        return $this->morphMany('App\Models\Attribute', 'attributable');
    }
}
