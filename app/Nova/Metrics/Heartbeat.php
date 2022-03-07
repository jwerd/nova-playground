<?php

namespace App\Nova\Metrics;

use App\Models\Server;
use App\Models\ServerHeartbeat;
use App\Models\Traits\TrendBuilder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class Heartbeat extends Trend
{
    use TrendBuilder;
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request, Server $server)
    {
        $max = $this->translateRangeToMinutes($request->get('range'));
        $current = 0;
        $results = [];
        while($current < $max) {
            $current += 5;
            if($current <= 60) {
                $date = (string) now()->subMinutes($current)->diffForHumans();
            } else {
                $date = (string) now()->subMinutes($current)->format('g:i a l jS F Y');
            }
            $results[$date] = rand(1,30);
        }
        return (new TrendResult)->trend(array_reverse($results));

        //return $this->countByMinutes($request, ServerHeartbeat::class, 'current_player_count');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return $this->getRange();
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'heartbeat';
    }
}
