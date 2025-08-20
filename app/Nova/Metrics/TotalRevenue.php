<?php

namespace App\Nova\Metrics;


use App\Models\OrderDetail;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;
use Illuminate\Support\Facades\DB;

class TotalRevenue extends Trend
{
    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        $total = OrderDetail::sum(DB::raw('qty * price'));
       

        return $this->result($total)
            ->format(',0')
            ->suffix('IDR');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array<int, string>
     */
    public function ranges(): array
    {
        return [
//            30 => Nova::__('30 Days'),
//            60 => Nova::__('60 Days'),
//            90 => Nova::__('90 Days'),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     */
    public function cacheFor(): DateTimeInterface|null
    {
        // return now()->addMinutes(5);

        return null;
    }

    /**
     * Get the URI key for the metric.
     */
    public function uriKey(): string
    {
        return 'total-revenue';
    }
    /**
     * Format the value for display.
     *
     * @param  mixed  $value
     */

}
