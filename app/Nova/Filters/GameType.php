<?php

namespace App\Nova\Filters;

use App\Models\Game;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class GameType extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if(is_array($value) && count($value)) {
            // Remove unchecked values
            $values = collect($value)->reject(function ($v) {
                return !$v;
            })->all();

            return $query->whereIn('game_id', array_keys($values));
        }
    }

    public function default()
    {
        return true;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return Game::all()->pluck('id', 'name')->all();
    }
}
