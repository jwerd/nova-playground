<?php

namespace App\Nova\Metrics;

use App\Models\Server;
use App\Models\ServerHeartbeat;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class Heartbeat extends Trend
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request, Server $server)
    {
        //dd($request->all(), $server);
        $max = 60*60;
        $current = 0;
        $results = [];
        while($current < $max) {
            $current += 300;
            $date = (string) now()->subSeconds($current)->diffForHumans();
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
        return [
            10 => __('Last 10 minutes'),
            30 => __('30 minutes'),
            60 => __('60 minutes'),
            90 => __('90 minutes'),
        ];
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
