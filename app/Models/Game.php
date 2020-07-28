<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function server() {
        return $this->hasMany(Server::class);
    }

    /**
     * Get all of the games's attributes.
     */
    public function attributes()
    {
        return $this->morphMany('Attribute', 'attributable');
    }
}
