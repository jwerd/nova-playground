<?php

namespace App\Models\Traits;

use Illuminate\Support\Arr;

trait TrendBuilder
{
    public function translateRangeToMinutes($range): int
    {
        $ranges = [
            '10m' => 10,
            '30m' => 30,
            '60m' => 60,
            '2h'  => 120,
            '6h'  => 60 * 6,
            '12h' => 60 * 12,
            '1d'  => 60 * 24,
            '7d'  => 60 * 24 * 7,
        ];

        return Arr::get($ranges, $range, 60);
    }

    public function getRange(): array
    {
        return [
            '10m' => __('Last 10 minutes'),
            '30m' => __('30 minutes'),
            '60m' => __('60 minutes'),
            '2h' => __('2 hours'),
            '6h' => __('6 hours'),
            '12h' => __('12 hours'),
            // '1d' => __('1 day'),
            // '7d' => __('7 days'),
        ];
    }
}
