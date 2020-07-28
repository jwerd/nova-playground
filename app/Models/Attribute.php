<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'attributable',
        'property',
        'property_value'
    ];
    public function attributable()
    {
        return $this->morphTo();
    }
}
